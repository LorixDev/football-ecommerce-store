-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 17. kvě 2023, 20:21
-- Verze serveru: 5.7.17
-- Verze PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `e_shop`
--
CREATE DATABASE IF NOT EXISTS `e_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `e_shop`;

-- --------------------------------------------------------

--
-- Struktura tabulky `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Vypisuji data pro tabulku `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Boty'),
(2, 'Dresy'),
(3, 'Tepláky'),
(4, 'Mikiny'),
(5, 'Doplňky'),
(6, 'Štulpny'),
(7, 'Trička'),
(8, 'Míče');

-- --------------------------------------------------------

--
-- Struktura tabulky `clothing_sizes_quantity`
--

DROP TABLE IF EXISTS `clothing_sizes_quantity`;
CREATE TABLE `clothing_sizes_quantity` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `clothing_sizes_quantity`
--

INSERT INTO `clothing_sizes_quantity` (`id`, `product_id`, `size_id`, `quantity`) VALUES
(1, 6, 1, 7),
(2, 6, 2, 20),
(3, 6, 3, 15),
(4, 6, 4, 5),
(5, 6, 5, 2),
(6, 9, 1, 5),
(7, 9, 2, 10),
(8, 9, 3, 10),
(9, 9, 4, 2),
(10, 9, 5, 3),
(11, 9, 2, 3),
(12, 10, 1, 4),
(13, 11, 2, 4),
(14, 16, 3, 3),
(15, 16, 4, 4),
(16, 19, 5, 6),
(17, 20, 4, 7),
(19, 21, 4, 11),
(20, 22, 3, 7),
(21, 25, 4, 4);

-- --------------------------------------------------------

--
-- Struktura tabulky `descriptions`
--

DROP TABLE IF EXISTS `descriptions`;
CREATE TABLE `descriptions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `descriptions`
--

INSERT INTO `descriptions` (`id`, `product_id`, `description`) VALUES
(1, 1, 'Nike Mercurial Vapor XIII jsou kopačky s vysokou úrovní technologie, které jsou určené pro rychlost a agilitu na hřišti. Jsou vyrobeny z lehkých a odolných materiálů, které poskytují hráčům potřebnou podporu a pohodlí během hry. Jsou oblíbené mezi profesionálními fotbalisty a patří mezi nejlepší kopačky na trhu.'),
(2, 2, 'Fotbalové kopačky Adidas X Ghosted jsou navrženy pro rychlost a pohyb na hřišti. Jejich lehká konstrukce a úzký tvar zajistí dokonalou kontrolu nad míčem a maximální rychlost běhu.'),
(3, 3, 'Puma Future 5.1 jsou moderní fotbalové kopačky, které vynikají svým inovativním designem a přesností. Jejich tvar je navržen tak, aby se perfektně přizpůsobil noze a zajišťoval dokonalý kontakt s míčem.'),
(4, 4, 'Fotbalové kopačky Under Armour Spotlight jsou vyrobeny z kvalitních materiálů a navrženy pro rychlé pohyby a maximální výkon na hřišti. Jejich lehká konstrukce a úzký tvar zajistí dokonalou kontrolu nad míčem a maximální rychlost běhu.'),
(5, 5, 'New Balance Furon v5 jsou moderní fotbalové kopačky s vynikajícími vlastnostmi pro rychlost a pohyb na hřišti. Jejich lehká konstrukce a úzký tvar zajistí dokonalou kontrolu nad míčem a maximální rychlost běhu.'),
(6, 6, 'Adidas Tiro 23 Club je moderní fotbalový dres s atraktivním designem a kvalitním materiálem pro maximální pohodlí a výkon na hřišti.'),
(7, 7, 'Puma El Classico Hybrid je moderní fotbalový míč s vynikajícími vlastnostmi pro rychlost a přesnost. Je navržen tak, aby se perfektně přizpůsobil noze a zajišťoval dokonalý kontakt s míčem.'),
(8, 8, 'Puma King Ankle jsou moderní fotbalové kopačky s klasickým designem a vynikajícími vlastnostmi pro pohodlí a výkon na hřišti. Jejich kvalitní materiál a pevná konstrukce zajistí dokonalou kontrolu nad míčem a maximální rychlost běhu.'),
(9, 9, 'Puma Czech Republic FtblCore je moderní fotbalový dres s atraktivním designem a kvalitním materiálem pro maximální pohodlí a výkon na hřišti. Podpořte svůj tým a ukážte svou loajalitu v tomto skvělém dresu.'),
(10, 10, 'Adidas Tiro 23 League je moderní fotbalové triko s atraktivním designem a kvalitním materiálem pro maximální pohodlí a výkon na hřišti.'),
(11, 11, 'Adidas Tiro 22 Competition triko je vyrobeno z kvalitního materiálu a je ideální pro sportovní aktivity. Triko je velmi pohodlné a prodyšné, takže se v něm budete cítit skvěle i při náročnějších cvičeních.'),
(12, 12, 'Fotbalový míč Nike Flight s technologií Aerowsculpture pro stabilní let a přesnou trajektorii. Vynikající míč pro soutěžní zápasy na nejvyšší úrovni.'),
(21, 16, 'Pánské tréninkové kalhoty Nike Dri-FIT Park 20 jsou ušité z materiálu, který spolehlivě odvádí pot pryč od pokožky. Disponují elastickým pasem s vnitřní stahovací šňůrkou, jenž je drží na místě za každé situace. Své věci můžeš uschovat do postranních kapes. Na levé nohavici se nachází logo Nike Swoosh.'),
(22, 17, 'Nejoblíbenější způsob uchycení chráničů je určitě pomocí pásky na štulpny. Často se však stává, že páska není pružná a hráč si nohu \"uškrtí\". Vyzkoušejte proto speciální pružný a samolepící tejp, který je lehký, prodyšný a přesto velmi pevný, takže chrániče udrží tam, kde mají být. Díky speciální struktuře můžete tejp používat opakovaně na několik zápasů a pořád bude lepit.'),
(23, 18, 'Štulpny Nike CLASSIC II se zesílenou patou a špičkou pro větší odolnost a žebrovanou manžetou, která zabraňuje shrnovaní. Vyrobené z vysoce odolných a pohodlných materiálů s technologií Dri-FIT, jenž vyniká vysokou prodyšností a dobrým odvodem potu.'),
(24, 19, 'Pánský zápasový dres s krátkým rukávem Nike Dri-FIT ADV Liverpool FC 2022/23, alternativní je ušitý z lehkého a rychleschnoucího materiálu. Vypadá úplně jako dresy, které na hřišti nosí největší fotbalové hvězdy, aby se cítily pohodlně a svěží. Technologie Dri-FIT ADV kombinuje materiál odvádějící vlhkost se špičkovou konstrukcí a dalšími prvky, díky kterým budeš v suchu a pohodlí. Zvýšený úplet v zahřívaných oblastech zlepšuje prodyšnost tam, kde to nejvíc oceníš. Design vypadá úplně stejně jako originální model, ve kterém hrají profíci.'),
(25, 20, 'Tréninkové kalhoty Nike Academy 21 jsou vyrobené z lehkého a savého materiálu s technologií Dri-FIT, který tě udrží v suchu a pohodlí po celý trénink. Standardní střih působí ležérně a uvolněně. Boční kapsy na zip.'),
(26, 21, 'Fotbalové sportovní tepláky, ve kterých na hřišti trefíš každý pohyb. Jsou vyrobeny z odvětrávané tkaniny Climacool, která tě udrží v suchu a chladu, a mají zúžený střih, takže ti perfektní dotyk nic nezkazí. Zipy u kotníků umožňují rychlé převlékání přes kopačky.'),
(27, 22, 'Triko Nike COOL HBR COMP je vyrobeno z příjemného elastického materiálu, který se sám přizpůsobí tělu. Technologie Dri-FIT odstraňuje vlhkost a tak udrží tvoje tělo v suchu a pohodě. Díky tomu zajišťuje maximální komfort i při velké fyzické zátěži. Komprese, která podporuje svaly v jejich přirozeném provozu, zlepšuje krevní oběh, a tím pomáhá při odstranění okysličení, které vzniká při cvičení. Na přední straně je Logo Nike Swoosh.'),
(28, 23, 'Dva kusy potítek Nike s výrazným logem. Jsou extra savé z kvalitních, měkčených a stabilizovaných materiálů, které bezpečně fixují zápěstí a účinně sají pot.'),
(29, 24, 'Skutečná fotbalová kariéra tě teprve čeká. Bezešvý míč adidas Al Rihla Pro je oficiálním zápasovým míčem pro mistrovství světa FIFA World Cup Qatar 2022™. Panely Speedshell inspirované plachetnicemi doplňuje texturovaný povrch a reliéfní kosočtverce, díky nimž míč lépe rotuje a přesněji létá. Pod perleťovou povrchovou úpravou září výrazná grafika.'),
(30, 25, 'S pánskými fotbalovými tepláky adidas ENT22 TR PNT trénujete jako profesionál. Jsou vyrobené ze savého materiálu AEROREADY, který vás udrží v suchu nejen na hřišti. Díky stahovací šňůrce v pase výborně drží na místě. Zipy u kotníků vám usnadní převlékání.');

-- --------------------------------------------------------

--
-- Struktura tabulky `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `payment` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `shipping` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `address`, `phone`, `payment`, `shipping`, `total`, `date_created`) VALUES
(9, 'Marek Marek', 'test@test.com', 'Hlavni 4', '+420722212841', 'cash', 'courier', '310.00', '2023-03-31 03:28:31'),
(10, 'Hammer Earl', 'eaglehamr@gmail.com', 'Jemenská 4', '+420610320741', 'card', 'post', '1550.00', '2023-03-31 07:39:25'),
(11, 'Hammer Earl', 'eaglehamr@gmail.com', 'Jemenská 4', '+420610320741', 'card', 'courier', '140.00', '2023-03-31 07:48:19'),
(12, 'test test', 'test@test.coco', 'Nepravidelna 4', '+420756841235', 'cash', 'courier', '560.00', '2023-03-31 08:17:12'),
(13, 'test test', 'test@test.cz', 'test', '+777777777', 'card', 'courier', '80.00', '2023-04-17 10:30:20');

--
-- Spouště `orders`
--
DROP TRIGGER IF EXISTS `delete_order_items`;
DELIMITER $$
CREATE TRIGGER `delete_order_items` AFTER DELETE ON `orders` FOR EACH ROW BEGIN
   DELETE FROM order_items WHERE order_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabulky `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `size` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Vypisuji data pro tabulku `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `size`, `price`, `quantity`) VALUES
(3, 9, 'Nike Mercurial Vapor XIII', '37', '140.00', 1),
(4, 9, 'Adidas X Ghosted', '38', '130.00', 1),
(5, 9, 'Puma El Classico Hybrid', '', '40.00', 1),
(6, 10, 'adidas Al Rihla Pro', '', '160.00', 8),
(7, 10, 'Adidas X Ghosted', '37', '130.00', 1),
(8, 10, 'Nike Mercurial Vapor XIII', '37', '140.00', 1),
(9, 11, 'New Balance Furon v5', '47', '110.00', 1),
(10, 11, 'Puma King Ankle', '', '15.00', 2),
(11, 12, 'Nike Mercurial Vapor XIII', '37', '140.00', 4),
(12, 13, 'Nike Dri-FIT Park 20', 'XL', '40.00', 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `others_quantity`
--

DROP TABLE IF EXISTS `others_quantity`;
CREATE TABLE `others_quantity` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `others_quantity`
--

INSERT INTO `others_quantity` (`id`, `product_id`, `quantity`) VALUES
(1, 8, 16),
(2, 7, 5),
(3, 12, 7),
(4, 17, 7),
(5, 18, 8),
(6, 23, 6),
(7, 24, 14);

-- --------------------------------------------------------

--
-- Struktura tabulky `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_path` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Vypisuji data pro tabulku `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `image_path`) VALUES
(1, 'Nike Mercurial Vapor XIII', 1, '10.00', 'nike_mercurial_vapor_xiii.jpg'),
(2, 'Adidas X Ghosted', 1, '130.00', 'adidas_x_ghosted.jpg'),
(3, 'Puma Future 5.1', 1, '120.00', 'puma_future_5_1.jpg'),
(4, 'Under Armour Spotlight', 1, '140.00', 'under_armour_spotlight.jpg'),
(5, 'New Balance Furon v5', 1, '110.00', 'new_balance_furon_v5.jpg'),
(6, 'Adidas Tiro 23 Club', 2, '30.00', '9ab6b60dd1fba0f50949c6fcd5c92281.jpg'),
(7, 'Puma El Classico Hybrid', 8, '40.00', 'b388e20249cde602684f18a6907f5f84.jpg'),
(8, 'Puma King Ankle', 5, '15.00', 'a7747ac72033df5e6e04d63e0f85065c.jpg'),
(9, 'Puma Czech Republic FtblCore', 7, '25.00', 'bf506c51c84c2ded3b8caa6513db947c.jpg'),
(10, 'Adidas Tiro 23 League', 4, '50.00', 'a07a327b3d3e983a1982d6df89de61b9.jpg'),
(11, 'Adidas Tiro 22 Competition', 2, '25.00', '734d3d4098220b13eccfed9f21755163.jpg'),
(12, 'Nike Flight', 8, '160.00', '89156de172b229144cc5259e2a07e2a1.jpg'),
(16, 'Nike Dri-FIT Park 20', 3, '40.00', '373914.jpg'),
(17, 'Tejp na štulpny', 5, '5.00', '88116362e1fca987d77f0a1ecc2151a8.png'),
(18, 'Nike CLASSIC II', 6, '15.00', '94330.jpg'),
(19, 'Liverpool alternativní', 2, '120.00', 'nike-lfc-m-nk-dfadv-match-jsy-ss-3r-2022-23-516425-dj7646-377.jpg'),
(20, 'Nike Academy 21', 3, '40.00', 'nike-y-nk-df-acd21-trk-pant-wpz-319168-cw6130-011.jpeg'),
(21, 'adidas Regista 18', 3, '30.00', '182681.jpg'),
(22, 'Nike COOL HBR COMP', 7, '25.00', '82311.jpg'),
(23, 'Nike Swoosh Potítka', 5, '15.00', '63481.jpg'),
(24, 'adidas Al Rihla Pro', 8, '160.00', '0206a794e7ca4cf0ac5bae6301079fec_9366.jpg'),
(25, 'adidas ENT22 TR PNT', 3, '45.00', 'adidas-ent22-tr-pnt-dblu_0.jpg');

--
-- Spouště `products`
--
DROP TRIGGER IF EXISTS `delete_product_descriptions`;
DELIMITER $$
CREATE TRIGGER `delete_product_descriptions` AFTER DELETE ON `products` FOR EACH ROW BEGIN
    DELETE FROM descriptions WHERE product_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabulky `shoe_sizes_quantity`
--

DROP TABLE IF EXISTS `shoe_sizes_quantity`;
CREATE TABLE `shoe_sizes_quantity` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `shoe_sizes_quantity`
--

INSERT INTO `shoe_sizes_quantity` (`id`, `product_id`, `size_id`, `quantity`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 6),
(3, 1, 3, 3),
(4, 2, 2, 10),
(5, 2, 3, 5),
(6, 2, 4, 2),
(7, 1, 5, 7),
(8, 1, 9, 6),
(9, 3, 6, 6),
(10, 4, 10, 7),
(11, 5, 12, 7);

-- --------------------------------------------------------

--
-- Struktura tabulky `shoe_sizing`
--

DROP TABLE IF EXISTS `shoe_sizing`;
CREATE TABLE `shoe_sizing` (
  `id` int(11) NOT NULL,
  `Velikost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `shoe_sizing`
--

INSERT INTO `shoe_sizing` (`id`, `Velikost`) VALUES
(1, 36),
(2, 37),
(3, 38),
(4, 39),
(5, 40),
(6, 41),
(7, 42),
(8, 43),
(9, 44),
(10, 45),
(11, 46),
(12, 47);

-- --------------------------------------------------------

--
-- Struktura tabulky `size_obleceni`
--

DROP TABLE IF EXISTS `size_obleceni`;
CREATE TABLE `size_obleceni` (
  `id` int(11) NOT NULL,
  `Velikost` varchar(20) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `size_obleceni`
--

INSERT INTO `size_obleceni` (`id`, `Velikost`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `admin`) VALUES
(3, 'Igor', 'igor@hnizdo.com', '$2y$10$RKGAPE6ZaF7/IlJFrw.XOeANjvZwSvSOKEuVnAqiQ/HQlp6aw68O6', '2023-03-26 21:17:52', 1),
(4, 'test', 'test@test.com', '$2y$10$WJAGhx5UU715lnPHBxdeDuxbo7qy9ChNdbB6m5F5P8QD4KH/fRGkO', '2023-03-29 13:00:39', 1),
(9, 'admin', 'admin@admin.cz', '$2y$10$tob6OcuoV5EB5OdxDapvFuDFGZ4q3Q3MyC8I8FweB3zgHatnKspZa', '2023-03-31 07:22:45', 1),
(10, 'EagleHamr', 'eaglehamr@gmail.com', '$2y$10$W1eXFk1SJ/Wqav6mJOMBr.lQwiDuCF98QpVRQx8AVxderAm.1rh7W', '2023-03-31 07:36:33', 0),
(11, 'testt', 'test@test.coco', '$2y$10$O374zzuW78tRTvyXRKKKxuLv5au1/7jSGqNmktNlJkdxFFbazcvri', '2023-03-31 08:14:00', 0),
(12, 'testtest', 'test@test.cz', '$2y$10$gNDXS1sBSNiARl9zZYldW.XouKfnyyZCWuQNFTrFXSKcz1zXvKX4y', '2023-04-17 10:30:54', 0);

--
-- Spouště `users`
--
DROP TRIGGER IF EXISTS `delete_orders_on_user_delete`;
DELIMITER $$
CREATE TRIGGER `delete_orders_on_user_delete` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
    DELETE FROM orders WHERE email = OLD.email;
END
$$
DELIMITER ;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `clothing_sizes_quantity`
--
ALTER TABLE `clothing_sizes_quantity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`product_id`),
  ADD KEY `fk_size_id` (`size_id`);

--
-- Klíče pro tabulku `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Klíče pro tabulku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Klíče pro tabulku `others_quantity`
--
ALTER TABLE `others_quantity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Klíče pro tabulku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Klíče pro tabulku `shoe_sizes_quantity`
--
ALTER TABLE `shoe_sizes_quantity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Klíče pro tabulku `shoe_sizing`
--
ALTER TABLE `shoe_sizing`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `size_obleceni`
--
ALTER TABLE `size_obleceni`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `clothing_sizes_quantity`
--
ALTER TABLE `clothing_sizes_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pro tabulku `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pro tabulku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pro tabulku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pro tabulku `others_quantity`
--
ALTER TABLE `others_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pro tabulku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pro tabulku `shoe_sizes_quantity`
--
ALTER TABLE `shoe_sizes_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pro tabulku `shoe_sizing`
--
ALTER TABLE `shoe_sizing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pro tabulku `size_obleceni`
--
ALTER TABLE `size_obleceni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table categories
--

--
-- Metadata for table clothing_sizes_quantity
--

--
-- Metadata for table descriptions
--

--
-- Metadata for table orders
--

--
-- Metadata for table order_items
--

--
-- Metadata for table others_quantity
--

--
-- Metadata for table products
--

--
-- Metadata for table shoe_sizes_quantity
--

--
-- Metadata for table shoe_sizing
--

--
-- Metadata for table size_obleceni
--

--
-- Metadata for table users
--

--
-- Metadata for database e_shop
--

--
-- Vypisuji data pro tabulku `pma__relation`
--

INSERT INTO `pma__relation` (`master_db`, `master_table`, `master_field`, `foreign_db`, `foreign_table`, `foreign_field`) VALUES
('e_shop', 'descriptions', 'product_id', 'e_shop', 'shoe_sizes_quantity', 'id'),
('e_shop', 'orders', 'email', 'e_shop', 'users', 'email'),
('e_shop', 'shoe_sizes_quantity', 'product_id', 'e_shop', 'products', 'id');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
