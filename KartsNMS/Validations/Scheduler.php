<?php
/**
 * Scheduler.php
 *
 * -Description-
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @link       https://www.itkarts.com
 */

namespace KartsNMS\Validations;

use Illuminate\Support\Facades\Cache;
use KartsNMS\Config;
use KartsNMS\ValidationResult;
use KartsNMS\Validator;

class Scheduler extends BaseValidation
{
    /**
     * Validate this module.
     * To return ValidationResults, call ok, warn, fail, or result methods on the $validator
     *
     * @param  Validator  $validator
     */
    public function validate(Validator $validator): void
    {
        if (! Cache::has('scheduler_working')) {
            $commands = $this->generateCommands($validator);
            $validator->result(ValidationResult::fail('Scheduler is not running')->setFix($commands));
        }
    }

    /**
     * @param  Validator  $validator
     * @return array
     */
    private function generateCommands(Validator $validator): array
    {
        $commands = [];
        $systemctl_bin = Config::locateBinary('systemctl');
        $base_dir = rtrim($validator->getBaseDir(), '/');

        if (is_executable($systemctl_bin)) {
            // systemd exists
            if ($base_dir === '/opt/kartsnms') {
                // standard install dir
                $commands[] = 'sudo cp /opt/kartsnms/dist/kartsnms-scheduler.service /opt/kartsnms/dist/kartsnms-scheduler.timer /etc/systemd/system/';
            } else {
                // non-standard install dir
                $commands[] = "sudo sh -c 'sed \"s#/opt/kartsnms#$base_dir#\" $base_dir/dist/kartsnms-scheduler.service > /etc/systemd/system/kartsnms-scheduler.service'";
                $commands[] = "sudo sh -c 'sed \"s#/opt/kartsnms#$base_dir#\" $base_dir/dist/kartsnms-scheduler.timer > /etc/systemd/system/kartsnms-scheduler.timer'";
            }
            $commands[] = 'sudo systemctl enable kartsnms-scheduler.timer';
            $commands[] = 'sudo systemctl start kartsnms-scheduler.timer';

            return $commands;
        }

        // non-systemd use cron
        if ($base_dir === '/opt/kartsnms') {
            $commands[] = 'sudo cp /opt/kartsnms/dist/kartsnms-scheduler.cron /etc/cron.d/';

            return $commands;
        }

        // non-standard install dir
        $commands[] = "sudo sh -c 'sed \"s#/opt/kartsnms#$base_dir#\" $base_dir/dist/kartsnms-scheduler.cron > /etc/cron.d/kartsnms-scheduler.cron'";

        return $commands;
    }
}
