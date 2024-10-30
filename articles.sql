create database articles_database;
USE articles_database;

-- Таблица для пользователей, включая авторов
CREATE TABLE Пользователи (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Имя VARCHAR(255) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Может_быть_автором BOOLEAN DEFAULT FALSE
);

-- Таблица для разделов и подразделов публикаций
CREATE TABLE Разделы (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Название VARCHAR(255) NOT NULL,
    Родительский_раздел_ID INT,
    FOREIGN KEY (Родительский_раздел_ID) REFERENCES Разделы(ID)
);

-- Таблица для публикаций
CREATE TABLE Публикации (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Заголовок VARCHAR(255) NOT NULL,
    Анонс TEXT,
    Описание TEXT,
    Дата_публикации TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Автор_ID INT,
    FOREIGN KEY (Автор_ID) REFERENCES Пользователи(ID)
);

-- Таблица для связи публикаций и разделов
CREATE TABLE Публикации_Разделы (
    Публикация_ID INT,
    Раздел_ID INT,
    PRIMARY KEY (Публикация_ID, Раздел_ID),
    FOREIGN KEY (Публикация_ID) REFERENCES Публикации(ID),
    FOREIGN KEY (Раздел_ID) REFERENCES Разделы(ID)
);

-- Таблица для тегов
CREATE TABLE Теги (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Название VARCHAR(255) NOT NULL
);

-- Таблица для связи публикаций и тегов
CREATE TABLE Публикации_Теги (
    Публикация_ID INT,
    Тег_ID INT,
    PRIMARY KEY (Публикация_ID, Тег_ID),
    FOREIGN KEY (Публикация_ID) REFERENCES Публикации(ID),
    FOREIGN KEY (Тег_ID) REFERENCES Теги(ID)
);

-- Таблица для комментариев
CREATE TABLE Комментарии (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Публикация_ID INT,
    Пользователь_ID INT,
    Текст TEXT NOT NULL,
    Дата TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Публикация_ID) REFERENCES Публикации(ID),
    FOREIGN KEY (Пользователь_ID) REFERENCES Пользователи(ID)
);

-- Таблица для оценок публикаций
CREATE TABLE Оценки (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Публикация_ID INT,
    Пользователь_ID INT,
    Оценка INT CHECK (Оценка BETWEEN 1 AND 5),
    FOREIGN KEY (Публикация_ID) REFERENCES Публикации(ID),
    FOREIGN KEY (Пользователь_ID) REFERENCES Пользователи(ID)
);

-- Таблица для связи авторов и публикаций (для нескольких авторов на одну статью)
CREATE TABLE Авторы_Публикаций (
    Публикация_ID INT,
    Автор_ID INT,
    PRIMARY KEY (Публикация_ID, Автор_ID),
    FOREIGN KEY (Публикация_ID) REFERENCES Публикации(ID),
    FOREIGN KEY (Автор_ID) REFERENCES Пользователи(ID)
);
