-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 01 Haz 2019, 17:32:14
-- Sunucu sürümü: 5.7.21
-- PHP Sürümü: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hayvanbarinakyonetimsistemi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `asi`
--

DROP TABLE IF EXISTS `asi`;
CREATE TABLE IF NOT EXISTS `asi` (
  `asiID` int(11) NOT NULL AUTO_INCREMENT,
  `asiAD` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `ilkAsilamaZamani` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `tekrari` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `maliyet` int(11) NOT NULL,
  PRIMARY KEY (`asiID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `asi`
--

INSERT INTO `asi` (`asiID`, `asiAD`, `ilkAsilamaZamani`, `tekrari`, `maliyet`) VALUES
(1, 'Kuduz Aşısı', '7 haftalıkken', '6 ayda bir', 5),
(2, 'Distemper', '7 haftalık yaşta', 'Yılda bir', 12),
(3, 'Hepatitis', '7 Haftalık yaşta', 'Yılda bir', 5),
(4, 'Köpek Boğmaca', '7 Haftalık yaşta', 'Yılda bir', 3),
(5, 'herpes', '7 Haftalık yaşta', 'Yılda bir', 4),
(6, 'Calici', '7 Haftalıkken', 'yılda bir', 44);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belediye`
--

DROP TABLE IF EXISTS `belediye`;
CREATE TABLE IF NOT EXISTS `belediye` (
  `belediyeID` int(11) NOT NULL,
  `belediyeAdi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `gelir` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kapasite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `belediye`
--

INSERT INTO `belediye` (`belediyeID`, `belediyeAdi`, `gelir`, `password`, `kapasite`) VALUES
(1, 'izmir', '99999 TL', '123123', 60);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belediye_asi`
--

DROP TABLE IF EXISTS `belediye_asi`;
CREATE TABLE IF NOT EXISTS `belediye_asi` (
  `belediyeID` int(11) NOT NULL,
  `asiID` int(11) NOT NULL,
  `stokSayısı` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `belediye_asi`
--

INSERT INTO `belediye_asi` (`belediyeID`, `asiID`, `stokSayısı`) VALUES
(1, 1, 144),
(1, 2, 25);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `belediye_hayvan`
--

DROP TABLE IF EXISTS `belediye_hayvan`;
CREATE TABLE IF NOT EXISTS `belediye_hayvan` (
  `belediyeID` int(11) NOT NULL,
  `hayvanID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `belediye_hayvan`
--

INSERT INTO `belediye_hayvan` (`belediyeID`, `hayvanID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gelirler`
--

DROP TABLE IF EXISTS `gelirler`;
CREATE TABLE IF NOT EXISTS `gelirler` (
  `belediyeID` int(11) NOT NULL,
  `gelirAdı` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `gelirTutarı` int(20) NOT NULL,
  `gelirTarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `gelirler`
--

INSERT INTO `gelirler` (`belediyeID`, `gelirAdı`, `gelirTutarı`, `gelirTarih`) VALUES
(1, 'gelir', 5000, '2018-01-15'),
(1, 'gelir', 5000, '2018-02-15'),
(1, 'gelir', 5000, '2018-03-15'),
(1, 'gelir', 5000, '2018-04-15'),
(1, 'gelir', 5000, '2018-05-15'),
(1, 'gelir', 5000, '2018-06-15'),
(1, 'gelir', 5000, '2018-07-15'),
(1, 'gelir', 5000, '2018-08-15'),
(1, 'gelir', 5000, '2018-09-15'),
(1, 'gelir', 5000, '2018-10-15'),
(1, 'gelir', 8000, '2018-11-15'),
(1, 'gelir', 5000, '2018-12-15'),
(1, 'gelir', 4500, '2019-01-15'),
(1, 'gelir', 4500, '2019-02-15'),
(1, 'gelir', 4500, '2019-03-15'),
(1, 'gelir', 4500, '2019-04-15'),
(1, 'gelir', 4500, '2019-05-15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvan`
--

DROP TABLE IF EXISTS `hayvan`;
CREATE TABLE IF NOT EXISTS `hayvan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `türID` int(11) NOT NULL,
  `cinsiyet` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `kayıtTarihi` date NOT NULL,
  `sağlıkDurumu` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `maliyet` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  `yaşı` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hayvan`
--

INSERT INTO `hayvan` (`id`, `türID`, `cinsiyet`, `kayıtTarihi`, `sağlıkDurumu`, `maliyet`, `yaşı`) VALUES
(1, 1, 'dişi', '2019-05-09', 'sağlıklı', '25 TL', '3 haftalık'),
(2, 2, 'erkek', '2019-05-01', 'kritik', '65 TL', '5 yıllık'),
(3, 2, 'dişi', '2019-05-25', 'çok sağlıklı', '123', '2 yıllık'),
(4, 2, 'dişi', '2019-05-25', 'çok sağlıklı', '123', '2 yıllık'),
(5, 1, 'erkek', '2019-05-08', 'iyi', '66', '2 haftalık');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hayvan_asi`
--

DROP TABLE IF EXISTS `hayvan_asi`;
CREATE TABLE IF NOT EXISTS `hayvan_asi` (
  `aşıID` int(11) NOT NULL,
  `hayvanID` int(11) NOT NULL,
  `sonAşıTarihi` date NOT NULL,
  `sonrakiAşıTarihi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `maliyet`
--

DROP TABLE IF EXISTS `maliyet`;
CREATE TABLE IF NOT EXISTS `maliyet` (
  `belediyeID` int(11) NOT NULL,
  `maliyetAdı` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `maliyetTutarı` int(11) NOT NULL,
  `maliyetTarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `maliyet`
--

INSERT INTO `maliyet` (`belediyeID`, `maliyetAdı`, `maliyetTutarı`, `maliyetTarih`) VALUES
(1, 'genel giderler', 3750, '2018-01-15'),
(1, 'genel giderler', 2800, '2018-02-15'),
(1, 'genel giderler', 2550, '2018-03-15'),
(1, 'genel giderler', 2500, '2018-04-15'),
(1, 'genel giderler', 2150, '2018-05-15'),
(1, 'genel giderler', 2689, '2018-06-15'),
(1, 'genel giderler', 2800, '2018-07-15'),
(1, 'genel giderler', 2560, '2018-08-15'),
(1, 'genel giderler', 2700, '2018-09-15'),
(1, 'genel giderler', 3000, '2018-10-15'),
(1, 'genel giderler', 3500, '2018-11-15'),
(1, 'genel giderler', 4000, '2018-12-15'),
(1, 'genel giderler', 3800, '2019-01-15'),
(1, 'genel giderler', 3500, '2019-02-15'),
(1, 'genel giderler', 2700, '2019-03-15'),
(1, 'genel giderler', 3100, '2019-04-15'),
(1, 'genel giderler', 2900, '2019-05-15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tür`
--

DROP TABLE IF EXISTS `tür`;
CREATE TABLE IF NOT EXISTS `tür` (
  `türID` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(10) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`türID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tür`
--

INSERT INTO `tür` (`türID`, `ad`) VALUES
(1, 'Kedi'),
(2, 'Köpek');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
