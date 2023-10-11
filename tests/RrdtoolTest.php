<?php
/**
 * RrdtoolTest.php
 *
 * Tests functionality of our rrdtool wrapper
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
 *
 * @copyright  2016 Tony Murray
 * @author     Tony Murray <murraytony@gmail.com>
 */

namespace KartsNMS\Tests;

use KartsNMS\Config;
use KartsNMS\Data\Store\Rrd;

class RrdtoolTest extends TestCase
{
    public function testBuildCommandLocal(): void
    {
        Config::set('rrdcached', '');
        Config::set('rrdtool_version', '1.4');
        Config::set('rrd_dir', '/opt/kartsnms/rrd');

        $cmd = $this->buildCommandProxy('create', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('create /opt/kartsnms/rrd/f o', $cmd);

        $cmd = $this->buildCommandProxy('tune', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('tune /opt/kartsnms/rrd/f o', $cmd);

        $cmd = $this->buildCommandProxy('update', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('update /opt/kartsnms/rrd/f o', $cmd);

        $this->app->forgetInstance(Rrd::class);
        Config::set('rrdtool_version', '1.6');

        $cmd = $this->buildCommandProxy('create', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('create /opt/kartsnms/rrd/f o -O', $cmd);

        $cmd = $this->buildCommandProxy('tune', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('tune /opt/kartsnms/rrd/f o', $cmd);

        $cmd = $this->buildCommandProxy('update', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('update /opt/kartsnms/rrd/f o', $cmd);
    }

    public function testBuildCommandRemote(): void
    {
        Config::set('rrdcached', 'server:42217');
        Config::set('rrdtool_version', '1.4');
        Config::set('rrd_dir', '/opt/kartsnms/rrd');

        $cmd = $this->buildCommandProxy('create', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('create /opt/kartsnms/rrd/f o', $cmd);

        $cmd = $this->buildCommandProxy('tune', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('tune /opt/kartsnms/rrd/f o', $cmd);

        $cmd = $this->buildCommandProxy('update', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('update f o --daemon server:42217', $cmd);

        $this->app->forgetInstance(Rrd::class);
        Config::set('rrdtool_version', '1.6');

        $cmd = $this->buildCommandProxy('create', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('create f o -O --daemon server:42217', $cmd);

        $cmd = $this->buildCommandProxy('tune', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('tune f o --daemon server:42217', $cmd);

        $cmd = $this->buildCommandProxy('update', '/opt/kartsnms/rrd/f', 'o');
        $this->assertEquals('update f o --daemon server:42217', $cmd);
    }

    public function testBuildCommandException(): void
    {
        Config::set('rrdcached', '');
        Config::set('rrdtool_version', '1.4');

        $this->expectException('KartsNMS\Exceptions\FileExistsException');
        // use this file, since it is guaranteed to exist
        $this->buildCommandProxy('create', __FILE__, 'o');
    }

    private function buildCommandProxy($command, $filename, $options)
    {
        // todo better tests
        $reflection = new \ReflectionClass(Rrd::class);
        $method = $reflection->getMethod('buildCommand');
        $method->setAccessible(true);

        return $method->invokeArgs($this->app->make(Rrd::class), func_get_args());
    }
}
