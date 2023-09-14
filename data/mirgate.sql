create table user
(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) not null,
    `email` varchar(255),
    `phone` varchar(20),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table user_setting
(
    `user_id` int(11) NOT NULL,
    `setting_name` varchar(255) not null,
    `setting_value` varchar(255) not null,
    CONSTRAINT `user_setting_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table user_code
(
    `user_id` int(11) NOT NULL,
    `code` varchar(20) not null,
    `datetime` timestamp default CURRENT_TIMESTAMP,
    CONSTRAINT `user_code_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;