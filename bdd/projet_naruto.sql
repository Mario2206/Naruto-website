-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 31 mai 2020 à 17:22
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_naruto`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `village` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `subDate` datetime NOT NULL,
  `avatar` text NOT NULL,
  `vKey` text NOT NULL,
  `isVerif` tinyint(1) NOT NULL,
  `remember_key` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `mail`, `password`, `village`, `birthdate`, `subDate`, `avatar`, `vKey`, `isVerif`, `remember_key`) VALUES
(89, 'Mario', 'Mars', 'Mario22061', 'mathieu.2001@hotmail.fr', '$argon2i$v=19$m=65536,t=4,p=1$SkFrWnhMb1dHVmx5NEZYcg$NlQnZl3+KRbp8TOcXb8H61MxZ/UXhKrggjqDqeJx1Js', 'suna', '2001-03-03', '2020-05-20 23:30:20', 'img_uploaded/profil/4c8c09d09a2f9fb25fac11821c081406bb1acd8dcf7c8026808b381d7ab9d2440fb66658b2b6e236651a701a0587947e3dc5944b507812afdd1a6d49d4f1734a.jpg', '9417955994', 1, '819937703024402025'),
(90, 'Testy', 'Test', 'Ninja9', 'mathieu2201@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$alJUTlVISUZqWkluSFA2SQ$1WDGwuLtnesb9V0gFSgFH6k8rO37lFp5yjjonGUed4Y', 'konoha', '2001-03-02', '2020-05-25 11:38:30', 'img_uploaded/profil/d0195cfbdb12a655c6ffda5413f5f0f53f4062802fb3e90f051b9b92b8e93f037eefbd0921cbf7d14ec5152a1cf62bf67b632a5427bc22088ada84120ae35e45.png', '57749897269499213', 1, ''),
(91, 'Petit', 'Markus', 'Markus142', 'mail@mail.fr', '$argon2i$v=19$m=65536,t=4,p=1$bnZhWnZZUmNpTThjLmRNWg$cY6fHbWW1k8S9O8LCylrZNMyd+inR2S4ePV4l7p32Kk', 'iwa', '1999-03-03', '2020-05-29 14:41:00', 'img_uploaded/profil/bcee86ba0938c06fcf82676fd4b162ac7f4e0d77b9eaa83ab594f1aed13d8e413d00bad0c974711e304d8a31fe2e2680dd8ca35c8f058aab84f53fefbc67bb72.png', '642213495003516385', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `miniature` varchar(500) NOT NULL,
  `synopsis` text NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `online_date` datetime NOT NULL,
  `is_online` tinyint(1) NOT NULL,
  `like_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `miniature`, `synopsis`, `content`, `creation_date`, `online_date`, `is_online`, `like_number`) VALUES
(39, 'Naruto contre Kabuto', 'img_uploaded/post/37ffc9fecc4b5ffd77ee6113b16b1e1714607cc4a377b0299d6e7939ab6c5f139cd5ad05c4a9d389dc048c31dbf4fa0cda51460ef58485145eaeb1675cefd35e.jpg', 'La première apparition de Kabuto !', '<div style=\"margin: 0px 28.8px 0px 14.4px; padding: 0px; width: 436.8px; text-align: left; float: right; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255); text-decoration-style: initial; text-decoration-color: initial;\"></div><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&nbsp;</p><p><br></p><p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.&nbsp;</p><p><br></p><p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p style=\"text-align: center; \"><img src=\"https://cdn.shopify.com/s/files/1/0046/2779/1960/files/kabuto_yakushi.jpg?v=1584719571\" alt=\"\"><br></p><p><br></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><p><br></p><p><br></p>', '2020-05-29 01:00:11', '2020-05-29 01:00:11', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `articles_like`
--

CREATE TABLE `articles_like` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles_like`
--

INSERT INTO `articles_like` (`id`, `account_id`, `article_id`, `date`) VALUES
(33, 89, 39, '2020-05-31 13:45:53');

-- --------------------------------------------------------

--
-- Structure de la table `characters`
--

CREATE TABLE `characters` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `online_date` datetime NOT NULL,
  `is_online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `characters`
--

INSERT INTO `characters` (`id`, `name`, `image`, `description`, `creation_date`, `online_date`, `is_online`) VALUES
(8, 'Sasuke', 'img_uploaded/characters/bf1758b8602ee66306daa7ef748aeb1616d843fda9d6e1f30569244ec83aabc29d3c8f2fe519d0729e6c80a7e7a71497ce523a233f15eda848ff6ff8bc4bc309.png', 'Sasuke Uchiwa est un ninja de renom. Très jeune, il développe des capacité exceptionnelles et il est doté d\'une détermination sans faille. Une explication existe : Sasuke a perdu toute sa famille qui a été sauvagement assassiné par son frère : Itashi Uchiwa. Cet évènement le changera à jamais et le traumatisme ne faiblira jamais.\r\n\r\n\r\nC\'est à l\'académie qu\'il me rencontre. Au début, on ne s\'aime pas vraiment, je dois bien avoué que j\'étais un tout petit peu jaloux de lui, mais vraiment un tout petit peu. Par contre, je ne supportais pas la façon dont Sakura le regardait, pourquoi elle ne me regardait pas comme ça ???\r\n\r\nBon, heureusement, on a finis par s\'entendre et on est devenu de très bons amis. Il le valait mieux car on fait parti de la même équipe aujourd\'hui ! On doit se protéger et s\'entraider constamment donc forcemment ça renforce les liens ! J\'espère que notre amitié ne cessera jamais de briller !!', '2020-05-29 00:25:58', '2020-05-29 00:41:57', 1),
(9, 'Sakura', 'img_uploaded/characters/a4a9726ee8c2677059ff31e859be93caa389ece0c0a0348424763ad3a7394ca7bf444ff0aa0c2cdad49951eb97044cc3a1020b0e1326402d58ca1bb52b939aaf.jpg', 'Sakura haruno est une de mes meilleurs amis ! Elle me plait enormement, je crois que je suis amoureux hihi !! Mais bon, malheureusement, elle prefere Sasuke avec son air tenebreux ... Je comprends pas pourquoi mais bon c\'est comme ça ... Puis elle est toujours la quand j\'en ai besoin (elle est aussi la pour me corriger quand il y a besoin malheureusement).\r\n                             \r\nElle est un peu réservé lors des missions, mais je sais qu\'un jour elle prendra encore plus de confiance et elle deviendra une grande ninja ! Elle a un grand sens de l\'honneur et elle s\'implique toujours pour protéger ses amis. C\'est une partenaire indispensable !\r\n                               \r\nJe ne connais pas vraiment ses parents, ils sont assez discrets mais ils semblent très sympathiques. Par contre, je connais très bien sa grande rivale : Ino Yamanaka. Elles se battent toutes les deux pour les bonnes faveurs de Sasuke. Je le repete encore une fois, je ne sais pas pourquoi ...  ', '2020-05-29 00:49:15', '2020-05-29 00:49:15', 1),
(10, 'Kakashi', 'img_uploaded/characters/49eea99a6fa0583c1cd547b7cddec3f3003fa9b95e28126c9de6102bdc6957f7ed24a0674244fa0dde18bf3500d723d3596f20a988c117201086a2f891ee9a36.png', 'Kakashi Sensei est le meilleur Sensei de Konoha et c\'est surtout le mien ! Il a une grande patience et un calme légendaire. Par contre, il n\'est absolument pas ponctuel, c\'est un véritable calvaire de l\'attendre pour partir en mission. Mais bon, ses bons conseils et sa confiance à notre egard compensent bien. \r\n                             \r\nEn plus d\'être un Sensei extraordinaire, c\'est un ninja comme on en voit un tous les cents ans. Il est le seul ninja n\'appartenant pas au clan Ushiwa à avoir le sharingan. C\'est une puissante pupille qui confere de grands pouvoirs à son détenteur. Par contre, ne me demandez pas comment il l\'a eu je n\'en ai aucune idée. Il faudrait que je lui pose la question d\'ailleurs...\r\n                               \r\nD\'ailleurs, il me semble qu\'il a fait partis des forces spéciales de Konoha. C\'est impressionnant car seules les meilleurs ninjas font partis de cette elite !! ', '2020-05-29 00:51:26', '2020-05-29 15:31:53', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments_article`
--

CREATE TABLE `comments_article` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments_article`
--

INSERT INTO `comments_article` (`id`, `article_id`, `user_id`, `content`, `date`, `reply`) VALUES
(34, 39, 89, 'Super Article !! Continue comme ça !!', '2020-05-29 01:03:02', ''),
(35, 39, 91, 'Pas fou ...', '2020-05-29 15:05:56', ''),
(36, 39, 89, 'Super articles !!', '2020-05-29 15:21:53', '');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sending_date` datetime NOT NULL,
  `already_seen` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `sender`, `subject`, `message`, `sending_date`, `already_seen`) VALUES
(21, 'mathieu.2001@hotmail.fr', 'Test1', 'Intellectum est enim mihi quidem in multis, et maxime in me ipso, sed paulo ante in omnibus, cum M. Marcellum senatui reique publicae concessisti, commemoratis praesertim offensionibus, te auctoritatem huius ordinis dignitatemque rei publicae tuis vel doloribus vel suspicionibus anteferre. Ille quidem fructum omnis ante actae vitae hodierno die maximum cepit, cum summo consensu senatus, tum iudicio tuo gravissimo et maximo. Ex quo profecto intellegis quanta in dato beneficio sit laus,  zdqd.', '2020-05-19 18:31:13', 1),
(22, 'mathieu.2001@hotmail.fr', 'test2', '///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////', '2020-05-19 18:32:53', 1),
(23, 'mario@mail.com', 'SUjet', 'je tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tesje tes', '2020-05-19 21:58:07', 1),
(24, 'example@mailtst.com', 'TestContact', 'zdjzhe qdh efeqf gefyeg qfu egs fesfe sf', '2020-05-20 19:45:07', 1),
(25, 'mathieu.2001@hotmail.fr', 'TestContact', 'zdjzhe qdh efeqf gefyeg qfu egs fesfe sf', '2020-05-20 19:57:08', 1),
(26, 'antony1510.2007@outlook.com', 'Demande par TOTO', 'Ceci est une demande de contact fait par Antony', '2020-05-21 13:38:05', 1),
(27, 'test@mail.com', 'testdnf', 'efesf sf rsgsr gsrg rsgrsgrzg reg re', '2020-05-25 19:04:54', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact_reply`
--

CREATE TABLE `contact_reply` (
  `id` int(11) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `sending_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact_reply`
--

INSERT INTO `contact_reply` (`id`, `id_contact`, `sender`, `recipient`, `subject`, `message`, `sending_date`) VALUES
(21, 23, 'mathieu220601@gmail.com', 'mario@mail.com', 'RE: SUjet', 'zqdzqdzjlq dqzd hzqudh zu hd qehfueqhfuesufues  heuf es fhuhfesh fhoesh foues fufe souf oesuf esofh esif e sfhesfhoesuhfoeshf es foueshfesh foe sofhesoifh eoizfh ez fezouhfuezhfzeu fe zfuhezf ezuhf iezh foiez ifoeiz foiez fpezi fpize fpiez pfiez fehz oifh ezofu ezuof ezuf ezou fozerfuo  gru roz foezif oezh foezh foiez foze hfezh fuoez fouez oe zfhez fihezfiez ez hfez oiez fuoez hfuez hfoiei zif ezoifh ezi fizhe ohiezf hezh foeizsf', '2020-05-19 22:10:01'),
(22, 22, 'mathieu220601@gmail.com', 'mathieu.2001@hotmail.fr', 'RE: test2', 'Je teste un truc et oui je sais feusuf fu suef f u sfu eg sfu usef u fesfsufgsugr sfgrsfgrsg frsgf ugrsfgrs frs frgs f rsg frs fsrf', '2020-05-20 19:12:38'),
(23, 25, 'mathieu220601@gmail.com', 'mathieu.2001@hotmail.fr', 'RE: TestContact', 'dq azdeazfezfez fze fze fzer fgz hug fuzg uigfez fez gufeg u egfug uefg efg efg uefzg ufeug fezgu egfug uefg ue fzg uiefg uiezg fue fe ef ', '2020-05-20 19:57:23'),
(24, 26, 'mathieu220601@gmail.com', 'antony1510.2007@outlook.com', 'RE: Demande par TOTO', 'Bonjour Antony, merci de cette demande de contact. Je vous envoie mes sincères salutations. \r\n\r\nBonne journée à vous !!', '2020-05-21 13:39:12');

-- --------------------------------------------------------

--
-- Structure de la table `_admins`
--

CREATE TABLE `_admins` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `vkey` bigint(11) NOT NULL,
  `is_activated` tinyint(1) NOT NULL,
  `level` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `_admins`
--

INSERT INTO `_admins` (`id`, `admin_username`, `admin_password`, `mail`, `firstname`, `lastname`, `vkey`, `is_activated`, `level`, `date`) VALUES
(26, 'Mario22061', '$argon2i$v=19$m=65536,t=4,p=1$WndjNzBtaE9sMHdhTHgvTg$asKE9pMhXNEkY+Bse0B3owsf4OeKbEkNEGLkyqk1J/0', 'mathieu220601@gmail.com', 'Math', 'Raimb', 623770852397135739, 1, 1, '2020-05-25 16:37:52');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles_like`
--
ALTER TABLE `articles_like`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments_article`
--
ALTER TABLE `comments_article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_reply`
--
ALTER TABLE `contact_reply`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `_admins`
--
ALTER TABLE `_admins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `articles_like`
--
ALTER TABLE `articles_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `characters`
--
ALTER TABLE `characters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `comments_article`
--
ALTER TABLE `comments_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `contact_reply`
--
ALTER TABLE `contact_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `_admins`
--
ALTER TABLE `_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
