SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `student_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `students` (`id`, `name`, `address`, `student_id`) VALUES
(1, 'Alireza Ghorbani', 'Guilan-Rasht', 95122),
(2, 'Sara Karimi', 'Guilan-anzali', 95123),
(3, 'Reza Dehghan', 'kordestan-sanandaj', 95124);
