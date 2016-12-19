#DROP TABLE IF EXISTS articles;
CREATE TABLE IF NOT EXISTS articles
(
  id              SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pubdate         DATE,
  title           VARCHAR(255) NOT NULL,
  subtitle        VARCHAR(255),
  description     TEXT,
  content         TEXT NOT NULL
);

#DROP TABLE IF EXISTS img;
CREATE TABLE IF NOT EXISTS img
(
  link            VARCHAR(255) NOT NULL PRIMARY KEY,
  tooltip         VARCHAR(255),
  id_article      SMALLINT UNSIGNED NOT NULL,
  FOREIGN KEY (id_article) REFERENCES articles(id) ON DELETE CASCADE
);

# Дата в диапазоне от «1000-01-01» до «9999-12-31». MySQL хранит поле типа DATE в виде «YYYY-MM-DD» (ГГГГ-ММ-ДД).