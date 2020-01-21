
CREATE TABLE IF NOT EXISTS `#__pollAntwoorden`
(
    `id`                    int(255)      NOT NULL AUTO_INCREMENT,
    `vraag`                 varchar(255)  NOT NULL,
    `antwoord1`             int(255),
    `antwoord2`             int(255),
    `antwoord3`             int(255),
    `antwoord4`             int(255),


    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `#__pollAntwoorden` (`vraag`,`antwoord1`,`antwoord2`,`antwoord3`,`antwoord4`) VALUES ('','','','','');
