CREATE DATABASE IF NOT EXISTS cykor_web1_db;
USE cykor_web1_db;

-- user 정보 데이터 저장 테이블 생성
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- id 저장 
    username VARCHAR(50) NOT NULL UNIQUE, -- 사용자 이름 저장,동일한 이름 저장 불가
    password VARCHAR(255) NOT NULL, -- 비밀번호 저장
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user', 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- 계정 생성 시간 저장 
);


-- 게시물 데이터 저장 테이블 생성 
CREATE TABLE IF NOT EXISTS posts ( 
    id INT AUTO_INCREMENT PRIMARY KEY, -- 게시글 고유번호, 자동 증가
    title VARCHAR(100) NOT NULL, -- 게시글 제목, 공란 불가
    content TEXT NOT NULL, -- 게시물 내용, 공란 불가
    user_id INT NOT NULL, -- user id
    is_private BOOLEAN DEFAULT FALSE, -- 나만보기 기능 추가
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,-- 글 작성 시간 
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- 글 수정 시간, 현재 시간으로 갱신
    FOREIGN KEY (user_id) REFERENCES users(id) -- user_id 요소는 항상 user 테이블에 존재해야한다 
);