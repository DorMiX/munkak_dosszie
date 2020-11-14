DELIMITER $$
DROP FUNCTION IF EXISTS `getPKColumns` $$
CREATE DEFINER=`root`@`localhost` FUNCTION `getPKColumns`(
  dbName VARCHAR(64),
  tableName VARCHAR(64)) RETURNS text CHARSET utf8
BEGIN
  DECLARE PKColumns TEXT;
  SELECT GROUP_CONCAT(`COLUMN_NAME` SEPARATOR '`, `')
  FROM `information_schema`.`COLUMNS`
  WHERE (`TABLE_SCHEMA` = dbName)
    AND (`TABLE_NAME` = tableName)
    AND (`COLUMN_KEY` = 'PRI')
    INTO PKColumns;
  SET PKColumns = CONCAT('`', PKColumns, '`');
  RETURN PKColumns;
END $$
DELIMITER ;