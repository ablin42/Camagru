-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Novembre 2018 à 16:42
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_img` int(11) NOT NULL COMMENT 'id of the img being commented',
  `id_user` int(11) NOT NULL COMMENT 'id of the user commenting',
  `content` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `id_img`, `id_user`, `content`, `date`) VALUES
(1, 1, 39, 'trop nul wtf', '2018-11-15 07:16:06'),
(3, 1, 43, 'end me', '2018-11-19 03:09:34'),
(4, 4, 43, 'bordel de merde', '2018-11-19 03:09:57'),
(5, 3, 43, 'REEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE', '2018-11-19 03:13:39'),
(6, 3, 43, 'yesw', '2018-11-26 22:20:30');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0' COMMENT 'ID de l''user qui a upload l''image',
  `path` varchar(255) NOT NULL DEFAULT '/Camagru/images/',
  `name` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `nb_like` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `id_user`, `path`, `name`, `date`, `nb_like`) VALUES
(1, 43, '/Camagru/images/1.png', 'GIT GUD', '2018-11-08 09:31:35', 0),
(2, 39, '/Camagru/images/2.jpg', 'just readin\'', '2018-11-06 07:21:29', 1),
(3, 39, '/Camagru/images/3.jpg', 'twitter users in a nutshell', '2018-11-30 19:11:36', 1),
(4, 39, '/Camagru/images/4.jpg', 'croc moi la kike', '2018-11-04 04:10:03', 1),
(5, 38, '/Camagru/images/5.png', 'mfw', '2018-11-07 23:43:40', 1),
(6, 38, '/Camagru/images/6.jpg', 'time kills', '2018-11-26 00:00:00', 0),
(7, 43, '/Camagru/images/7.png', 'end me', '2018-11-23 01:54:58', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mail_token` varchar(128) NOT NULL,
  `confirmed_token` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `mail_token`, `confirmed_token`) VALUES
(38, 'ablin', 'b4b69e22d686cf423559a72b8fc00477c3ee5e58b435c796df4f769f93efb866130609a3b3ee20c3bec2b76b5d2f91682d970611f7982a7082c2bbf55867497b', 'cfbd3b590e62ffdbe3daf17220fbdd34671380a6dbbb0084b2d62c492bd6dbe762ac97aa53af5417e965f4831b3a18e5086fae8ab3c1cf0c86643c63f9f26455', '', NULL),
(39, 'Harbinger', 'ac4152b523ec07d4e8c911e1465e1a7630db2c95420d661a8c813eced9d3a81319e18b877cf1580f4267748b3198753ac25e3b2b1d670bd4f3ed69e37a4a28ef', '008633babb7156460903bcac1810d1a8e99aec67a6c303d0316d50c34860f4205adb6419d0346043989fc6388cb5797c0a771b35c3cb8db9693667fff549c441', '', NULL),
(40, 'AUTISMO', 'ac4152b523ec07d4e8c911e1465e1a7630db2c95420d661a8c813eced9d3a81319e18b877cf1580f4267748b3198753ac25e3b2b1d670bd4f3ed69e37a4a28ef', '7cfc0fcb3a7a251c97838723b8dd0d87cf9dfdf67c9046686c3a490d14f3ffec4988ea6a0f36a339251f363b15e4a3f8191f6c725f08fd0a820ddc6b871b5449', 'lq5ls7iir025mi2f9dp9kcb066ihoywylr81osjisjd3plh52zjwocnb2e642u3t8zvcqkzd7ca2y9oj4b3fwyzobsaeviqxcpvd4fpfr2zyswi9btvgcom90z00mg78', NULL),
(41, 'ablin43qsdqsd', 'ac4152b523ec07d4e8c911e1465e1a7630db2c95420d661a8c813eced9d3a81319e18b877cf1580f4267748b3198753ac25e3b2b1d670bd4f3ed69e37a4a28ef', '6efaad539576fba0490bab18a246d8bc27c7c269d73f19ea3ccea836e586845dd6b395f950432efb07fa00f30ce048152087da098d9c84c68b144d25c2273eea', 'fno5hcg8ckvy1o7gra5c1d4bwqzq57bzci2jumz494sfoohl4bzqb56q4hff8amrj33ls39nqsvt88vyjwdhjbi3dkgn7oc7l3319i0nxmf4dkd5wl8omi3m1tdh97fe', NULL),
(42, 'ablinazeazeazdzad', 'ac4152b523ec07d4e8c911e1465e1a7630db2c95420d661a8c813eced9d3a81319e18b877cf1580f4267748b3198753ac25e3b2b1d670bd4f3ed69e37a4a28ef', 'e07d5373152e87cf13da3067e49a42b5a34aa54b22d4c7d13eef9fbb51d0c2eb0e9150b1e7a00a834922b8cb6e19baab342810438ca099dabf3cb8ec1e8eefc0', 'j0372hamjes1448xghwbycsndulfh2twkhwvq4yq8cb1z0fonnknddm92zzte9yt7vrtm2rh9va71ypydn0edq1qnwm774v829yfbebioy6wmaueze3fvorjjilyjuy9', NULL),
(43, 'Fiendish', '72135fa8697eae1c9002bad98bc07d44abc9180794dfa54ed68a1a23d750e505426b9ed67510e16f778e3cecf74770692498d6b7d964856f041b7cc7c1c96a9d', '7e654d24fd3526aa3c58d5f836e4bdb6415b62fa38832c459ddbdb277d1f0e1dfcba537c4bea339587baca27b44504ac96bcef33a33a4087649a88138e17e1dd', '3pzq60cnov5uqnmmvg4jsplq6q43x08znawafgf19h368sabbt8prdh2cd1d2t1490fjgyx1xghalu1svvzdcjrnish6q1qk6glhkdr36nuhaeae0xujk90bqh1mc705', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `id_img` int(11) NOT NULL COMMENT 'id of the img liked',
  `id_user` int(11) NOT NULL COMMENT 'id of the user liking'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `id_img`, `id_user`) VALUES
(13, 3, 44),
(97, 8, 43),
(83, 2, 43),
(84, 4, 43),
(85, 5, 43);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
