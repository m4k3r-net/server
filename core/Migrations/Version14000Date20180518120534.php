<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2018 Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Core\Migrations;

use OCP\DB\ISchemaWrapper;
use OCP\Migration\SimpleMigrationStep;
use OCP\Migration\IOutput;

class Version14000Date20180518120534 extends SimpleMigrationStep {

	/**
	 * @param IOutput $output
	 * @param \Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 */
	public function changeSchema(IOutput $output, \Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$table = $schema->createTable('authtoken_v2');
		$table->addColumn('id', 'integer', [
			'autoincrement' => true,
			'notnull' => true,
			'length' => 4,
			'unsigned' => true,
		]);
		$table->addColumn('uid', 'string', [
			'notnull' => true,
			'length' => 64,
			'default' => '',
		]);
		$table->addColumn('login_name', 'string', [
			'notnull' => true,
			'length' => 64,
			'default' => '',
		]);
		$table->addColumn('password', 'text', [
			'notnull' => false,
		]);
		$table->addColumn('name', 'text', [
			'notnull' => true,
			'default' => '',
		]);
		$table->addColumn('token', 'string', [
			'notnull' => true,
			'length' => 200,
			'default' => '',
		]);
		$table->addColumn('type', 'smallint', [
			'notnull' => true,
			'length' => 2,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('remember', 'smallint', [
			'notnull' => true,
			'length' => 1,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('last_activity', 'integer', [
			'notnull' => true,
			'length' => 4,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('last_check', 'integer', [
			'notnull' => true,
			'length' => 4,
			'default' => 0,
			'unsigned' => true,
		]);
		$table->addColumn('scope', 'text', [
			'notnull' => false,
		]);
		$table->addColumn('private_key', 'text', [
			'notnull' => true,
			'default' => '',
		]);
		$table->addColumn('public_key', 'text', [
			'notnull' => true,
			'default' => '',
		]);
		$table->setPrimaryKey(['id']);
		$table->addUniqueIndex(['token'], 'authtoken_token_index');
		$table->addIndex(['last_activity'], 'authtoken_last_activity_index');

		return $schema;
	}
}
