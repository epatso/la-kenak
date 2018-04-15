-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 15 Απρ 2018 στις 02:46:34
-- Έκδοση διακομιστή: 5.6.21
-- Έκδοση PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `labros_kenakv5`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `core_menu`
--

DROP TABLE IF EXISTS `core_menu`;
CREATE TABLE IF NOT EXISTS `core_menu` (
`id` int(11) NOT NULL,
  `is_category` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `link_type` int(11) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `accesslevel` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `core_menu`
--

INSERT INTO `core_menu` (`id`, `is_category`, `category_id`, `order`, `name`, `link`, `link_type`, `icon`, `accesslevel`, `active`) VALUES
(1, 1, 0, 1, 'Αρχική', '?nav=index', 0, 'fa fa-university', 0, 1),
(2, 1, 0, 2, 'Βιβλιοθήκη ΚΕΝΑΚ', '#', 0, 'fa fa-tree', 0, 1),
(3, 0, 2, 1, 'Λειτουργία κτιρίου', '?nav=library_synthikes', 0, 'fa fa-tree', 0, 1),
(4, 0, 2, 2, 'Συντελεστές U', '?nav=library_apaitiseis', 0, 'fa fa-leaf', 0, 1),
(5, 0, 2, 3, 'Κλιματικά δεδομένα', '?nav=library_climate', 0, 'fa fa-map-pin', 0, 1),
(6, 0, 2, 4, 'Σκιάσεις', '?nav=library_shading', 0, 'fa fa-umbrella', 0, 1),
(7, 0, 2, 5, 'Θερμογέφυρες', '?nav=library_thermo', 0, 'fa fa-building-o', 0, 1),
(8, 0, 2, 6, 'ΚΑ/Θεωρητικό', '?nav=library_ka', 0, 'fa fa-building', 0, 1),
(9, 0, 2, 7, 'Νομοθεσία', '?nav=library_laws', 0, 'fa fa-balance-scale', 0, 1),
(10, 0, 2, 8, 'Ηλιακή τροχιά', '?nav=library_solarpath', 0, 'fa fa-sun-o', 0, 1),
(11, 0, 2, 9, 'FAQ', '?nav=library_help', 0, 'fa fa-life-ring', 0, 1),
(12, 1, 0, 3, 'Βιβλιοθήκες υλικών', '#', 0, 'fa fa-university', 0, 1),
(13, 0, 12, 1, 'Υλικά ΚΕΝΑΚ', '?nav=library_materials', 0, 'fa fa-bars', 0, 1),
(14, 0, 12, 2, 'Συστήματα', '?nav=library_systems', 0, 'fa fa-industry', 0, 1),
(15, 0, 12, 3, 'Εξοικονομώ', '?nav=library_paremvaseis', 0, 'fa fa-sitemap', 0, 1),
(16, 1, 0, 4, 'Υπολογισμοί', '#', 0, 'fa fa-cogs', 0, 1),
(17, 0, 16, 1, 'U Αδιαφανών', '?nav=calc_adiafani', 0, 'fa fa-leaf', 0, 1),
(18, 0, 16, 2, 'U Διαφανών', '?nav=calc_diafani', 0, 'fa fa-lemon-o', 0, 1),
(19, 0, 16, 3, 'U ισοδύναμοι', '?nav=calc_isodynamoi', 0, 'fa fa-plus-square-o', 0, 1),
(20, 0, 16, 4, 'Θερμική ζώνη', '?nav=calc_synthikes', 0, 'fa fa-cubes', 0, 1),
(21, 1, 16, 5, 'Συστήματα', '#', 0, 'fa fa-industry', 0, 1),
(22, 0, 21, 1, 'Θέρμανση', '?nav=calc_therm', 0, 'fa fa-fire', 0, 1),
(23, 0, 21, 2, 'Ψύξη', '?nav=calc_cold', 0, 'fa fa-snowflake-o', 0, 1),
(24, 0, 21, 3, 'ΖΝΧ', '?nav=calc_znx', 0, 'fa fa-bath', 0, 1),
(25, 0, 21, 4, 'Ηλιακός', '?nav=calc_solar', 0, 'fa fa-sun-o', 0, 1),
(26, 0, 21, 5, 'Φωτισμός', '?nav=calc_light', 0, 'fa fa-lightbulb-o', 0, 1),
(27, 0, 21, 6, 'Αερισμός', '?nav=calc_kkm', 0, 'fa fa-flag', 0, 1),
(28, 0, 21, 7, 'Ύγρανση', '?nav=calc_ygransi', 0, 'fa fa-tint', 0, 1),
(29, 1, 16, 6, 'Σκιάσεων', '#', 0, 'fa fa-sun-o', 0, 1),
(30, 0, 29, 1, 'Ορίζοντα', '?nav=calc_fhor', 0, 'fa fa-ellipsis-v', 0, 1),
(31, 0, 29, 2, 'Προβόλου', '?nav=calc_fov', 0, 'fa fa-ellipsis-h', 0, 1),
(32, 0, 29, 3, 'Πλευρικών', '?nav=calc_ffin', 0, 'fa fa-eraser', 0, 1),
(33, 0, 29, 4, 'Πλευρικών x2', '?nav=calc_ffin2', 0, 'fa fa-arrows-h', 0, 1),
(34, 0, 29, 5, 'Τεντών', '?nav=calc_fovt', 0, 'fa fa-eraser', 0, 1),
(35, 0, 29, 6, 'Περσίδων', '?nav=calc_fsh', 0, 'fa fa-align-center', 0, 1),
(36, 0, 29, 7, 'Φύλλο ανοίγματος', '?nav=calc_fyllo', 0, 'fa fa-file-pdf-o', 0, 1),
(37, 0, 16, 7, 'Αμοιβές', '?nav=calc_amoives', 0, 'fa fa-euro', 0, 1),
(38, 0, 16, 8, 'Σενάρια xml', '?nav=calc_xml', 0, 'fa fa-random', 0, 1),
(39, 1, 0, 5, 'Μελέτη ΚΕΝΑΚ', '#', 1, 'fa fa-edit', 3, 1),
(40, 0, 39, 1, 'Γενικά στοιχεία', '?nav=meleti_general', 0, 'fa fa-map', 3, 1),
(41, 0, 39, 2, 'Ζώνες/ΜΘΧ', '?nav=meleti_zones', 0, 'fa fa-cubes', 3, 1),
(42, 0, 39, 3, 'Κέλυφος', '?nav=meleti_kelyfos', 0, 'fa fa-object-group', 3, 1),
(43, 0, 39, 4, 'Συστήματα', '?nav=meleti_systems', 0, 'fa fa-snowflake-o', 3, 1),
(44, 0, 39, 5, 'Σενάρια', '?nav=meleti_senaria', 0, 'fa fa-sitemap', 3, 1),
(45, 0, 39, 6, 'Σχεδίαση', '?nav=meleti_draw', 0, 'fa fa-paint-brush', 3, 1),
(46, 0, 39, 7, 'Έντυπα', '?nav=meleti_entypa', 0, 'fa fa-file-word-o', 3, 1),
(47, 0, 39, 8, 'Τεύχος', '?nav=meleti_print', 0, 'fa fa-file-pdf-o', 3, 1),
(48, 0, 39, 9, 'xml', '?nav=meleti_xml', 0, 'fa fa-paper-plane-o', 3, 1),
(49, 1, 0, 6, 'Χρήστης', '#', 0, 'fa fa-user', 0, 1),
(50, 0, 49, 1, 'Μελέτες', '?nav=user_login', 0, 'fa fa-building', 1, 1),
(51, 0, 49, 2, 'Λογαριασμός', '?nav=user_preferences', 0, 'fa fa-id-badge', 1, 1),
(52, 0, 49, 3, 'Βιβλιοθήκες', '?nav=user_libraries', 0, 'fa fa-briefcase', 1, 1),
(53, 0, 49, 4, 'Ημερολόγιο', '?nav=user_calendar', 0, 'fa fa-calendar', 1, 1),
(54, 0, 49, 5, 'Υποστήριξη', '?nav=user_messaging', 0, 'fa fa-envelope', 1, 1),
(55, 0, 49, 6, 'Αποσύνδεση', '?logoff', 0, 'fa fa-power-off', 1, 1),
(56, 0, 49, 7, 'Σύνδεση', '?nav=user_login', 0, 'fa fa-user', 0, 1),
(57, 1, 0, 7, '<font color=red>Διαχειριστής</font>', '#', 0, 'fa fa-black-tie', 2, 1),
(58, 0, 57, 1, 'Γενικά', '?nav=admin', 0, 'fa fa-tachometer', 2, 1),
(59, 0, 57, 2, 'Ρυθμίσεις', '?nav=admin_preferences', 0, 'fa fa-cog', 2, 1),
(60, 0, 57, 3, 'Χρήστες/Υποστήριξη', '?nav=admin_users', 0, 'fa fa-users', 2, 1),
(61, 0, 57, 4, 'Βιβλιοθήκες', '?nav=admin_libraries', 0, 'fa fa-briefcase', 2, 1),
(62, 0, 57, 5, 'Πρότυπα Έντυπα', '?nav=admin_entypa', 0, 'fa fa-file-word-o', 2, 1),
(63, 0, 57, 6, 'Πρότυπο τεύχος', '?nav=admin_print', 0, 'fa fa-file-pdf-o"', 2, 1);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `core_menu`
--
ALTER TABLE `core_menu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `core_menu`
--
ALTER TABLE `core_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
