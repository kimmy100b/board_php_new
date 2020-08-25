-- board테이블
CREATE TABLE `board` (
	`board_sid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '게시판 SID',
	`writer` VARCHAR(15) NULL DEFAULT NULL COMMENT '사용자 ID' COLLATE 'utf8_general_ci',
	`title` VARCHAR(50) NOT NULL COMMENT '게시판 제목' COLLATE 'utf8_general_ci',
	`passwd` VARCHAR(50) NULL DEFAULT NULL COMMENT '게시판 비밀번호' COLLATE 'utf8_general_ci',
	`content` MEDIUMTEXT NOT NULL COMMENT '게시판 내용' COLLATE 'utf8_general_ci',
	`register_date` DATE NOT NULL COMMENT '등록일',
	`modify_date` DATE NOT NULL COMMENT '수정일',
	PRIMARY KEY (`board_sid`) USING BTREE,
	INDEX `FK_board_user` (`writer`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=12;


