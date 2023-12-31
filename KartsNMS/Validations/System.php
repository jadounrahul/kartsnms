<?php
/*
 * System.php
 *
 * Validate system items
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
 * @package    KartsNMS
 * @link       https://www.itkarts.com
 * @copyright  2020 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\Validations;

use Illuminate\Support\Arr;
use KartsNMS\Config;
use KartsNMS\Validator;

class System extends BaseValidation
{
    protected static $RUN_BY_DEFAULT = true;

    /**
     * @inheritdoc
     */
    public function validate(Validator $validator): void
    {
        $install_dir = $validator->getBaseDir();

        $lnms = str_replace('lnms:', '', rtrim(`whereis -b lnms 2>/dev/null`));
        $path = rtrim(`echo "\$PATH"`);

        // if couldn't find lnms and we have PATH
        if (empty($lnms) && ! empty($path)) {
            $paths = explode(':', $path);
            $bin = Arr::first(array_intersect([
                '/usr/local/bin',
                '/usr/bin',
                '/bin',
            ], $paths), null, Arr::last($paths));

            $validator->warn('Global lnms shortcut not installed. lnms command must be run with full path', "sudo ln -s $install_dir/lnms $bin/lnms");
        }

        $bash_completion_dir = '/etc/bash_completion.d/';
        $completion_file = 'lnms-completion.bash';
        if (is_dir($bash_completion_dir) && ! file_exists("$bash_completion_dir$completion_file")) {
            $validator->warn('Bash completion not installed. lnms command tab completion unavailable.', "sudo cp $install_dir/misc/lnms-completion.bash $bash_completion_dir");
        }

        $rotation_file = '/etc/logrotate.d/kartsnms';
        if (! file_exists($rotation_file) && ! Config::get('installed_from_package')) {
            $validator->warn('Log rotation not enabled, could cause disk space issues', "sudo cp $install_dir/misc/kartsnms.logrotate $rotation_file");
        }
    }
}
