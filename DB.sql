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
AUTO_INCREMENT=12
;

--comment 테이블
CREATE TABLE `comment` (
	`comment_sid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유키',
	`user_id` VARCHAR(15) NOT NULL COMMENT '사용자 아이디' COLLATE 'utf8_general_ci',
	`board_sid` INT(10) UNSIGNED NOT NULL COMMENT '게시물 키',
	`comment_content` MEDIUMTEXT NOT NULL COMMENT '내용' COLLATE 'utf8_general_ci',
	`register_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
	PRIMARY KEY (`comment_sid`) USING BTREE,
	INDEX `FK_comment_member` (`user_id`) USING BTREE,
	INDEX `FK_comment_board` (`board_sid`) USING BTREE
)
COMMENT='게시판 댓글'
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
;

--file 테이블
CREATE TABLE `file` (
	`file_sid` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '일련번호',
	`board_sid` INT(11) UNSIGNED NOT NULL COMMENT '게시판 SID',
	`file_name_down` VARCHAR(50) NOT NULL COMMENT '파일명(다운링크용)' COLLATE 'utf8_general_ci',
	`file_name_org` VARCHAR(50) NOT NULL COMMENT '파일명(원 파일명)' COLLATE 'latin1_swedish_ci',
	`file_size` MEDIUMINT(8) UNSIGNED NOT NULL COMMENT '파일 사이즈(KB)',
	`file_type` VARCHAR(255) NOT NULL COMMENT '파일 타입' COLLATE 'utf8_general_ci',
	`file_down_count` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '다운로드 횟수',
	`file_reg_data` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
	PRIMARY KEY (`file_sid`) USING BTREE,
	INDEX `FK_file_board` (`board_sid`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=21
;

--user 테이블
CREATE TABLE `user` (
	`user_sid` INT(11) NOT NULL AUTO_INCREMENT COMMENT '고유키',
	`user_id` VARCHAR(15) NOT NULL COMMENT '아이디' COLLATE 'utf8_general_ci',
	`user_pw` VARCHAR(200) NOT NULL COMMENT '비밀번호' COLLATE 'utf8_general_ci',
	`user_name` VARCHAR(10) NOT NULL COMMENT '이름' COLLATE 'utf8_general_ci',
	`user_phone` CHAR(20) NOT NULL COMMENT '전화번호' COLLATE 'utf8_general_ci',
	`user_email` VARCHAR(80) NOT NULL COMMENT '이메일' COLLATE 'utf8_general_ci',
	`reg_date` DATETIME NOT NULL COMMENT '가입일자',
	`level` INT(11) NOT NULL DEFAULT '0' COMMENT '0:일반, 1:관리자',
	PRIMARY KEY (`user_sid`) USING BTREE
)
COLLATE='latin1_swedish_ci'
ENGINE=MyISAM
AUTO_INCREMENT=3
;


