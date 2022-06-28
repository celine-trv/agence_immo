-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `cp` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nb_pieces` tinyint(2) NOT NULL,
  `surface` int(5) NOT NULL,
  `prix` int(9) NOT NULL,
  `photo_1` varchar(255) NOT NULL,
  `photo_2` varchar(255) DEFAULT NULL,
  `photo_3` varchar(255) DEFAULT NULL,
  `type` enum('location','vente') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id`, `titre`, `ville`, `cp`, `nb_pieces`, `surface`, `prix`, `photo_1`, `photo_2`, `photo_3`, `type`, `description`) VALUES
(1, 'Hôtel particulier du début XXème', 'Paris 8è', 75008, 6, 124, 940000, 'img/logements/logement_1653747258_1.jpg', 'img/logements/logement_1653747258_2.jpg', 'img/logements/logement_1653747258_3.jpg', 'vente', 'Au cœur du 8è arrondissement, au calme, cet élégant hôtel particulier 6 pièces du début XXème est élevé de deux étages, avec jardin intimiste et piscine.\r\n\r\nEntièrement rénovée par une architecte de renom, cette propriété offre des pièces aux prestations soignées : au rez-de-chaussée une vaste pièce à vivre avec cuisine équipée, véritable espace de vie s\'ouvrant sur l’extérieur et la piscine au style très minéral. Un salon indépendant complète ce niveau et pourrait s’envisager en chambre.\r\n\r\nAu premier étage, deux chambres dont une pourvue d’une terrasse de 20m2, une salle de bains et une salle d’eau.\r\nAu dernier étage, deux chambres et une salle d’eau.\r\n\r\nUne vaste buanderie et un garage complètent cette habitation rare et avec beaucoup d’allure.'),
(2, 'Appartement sur le front de mer', 'La Ciotat', 13600, 2, 45, 850, 'img/logements/logement_1653749439_1.jpg', 'img/logements/logement_1653749439_2.jpg', 'img/logements/logement_1653749439_3.jpg', 'location', 'Appartement idéal vacances, ce T2 tout équipé avec vue imprenable sur la mer est situé au 1er étage d\'une résidence, avec balcon. 10min à pied du port, 5min des plages.\r\n\r\nIl se compose d\'une chambre à part, de 2 lits superposés une place dans le séjour et d\'un canapé lit 2 places. Idéal pour les familles avec 2 enfants ou groupes d\'amis.\r\n\r\nFacile d\'accès, avec un parking gratuit juste en face, un arrêt de bus et une station vélo à 50m.'),
(3, 'Chalet montagne coquet au calme', 'Perdu-Sur-Montagne', 74740, 3, 74, 740, 'img/logements/logement_1653901313_1.jpg', 'img/logements/logement_1653901313_2.jpg', NULL, 'location', 'Ce chalet 3 pièces sera votre location de vacances le temps d\'un moment d\'évasion. Calme, entouré par la nature, il est entièrement équipé et fonctionnel.'),
(4, 'Château incroyable sur son rocher', 'Paradis', 05860, 20, 6274, 54860000, 'img/logements/logement_1654972054_1.jpg', NULL, NULL, 'vente', 'Cet incroyable château de contes de fées incarne une esthétique intemporelle, avec de grandes fenêtres pour une lumière naturelle abondante. Profitez du parc de 4 ha avec une grande terrasse pour les réunions de groupe. Bien entendu il dispose de suites et de chambres de style individuel pour accueillir confortablement vos invités.\r\n\r\nLes 12 suites mesurent de 30 à 55 mètres carrés et, en raison de leur aménagement spacieux, peuvent accueillir facilement de 2 à 4 personnes chacune. Plusieurs suites de 2 étages disposent d\'une salle de bains privative pourvue d\'une douche à eau de pluie et d\'une baignoire individuelle pour se prélasser et se détendre.\r\n\r\nD\'autre part, les chambres ont été magnifiquement préparées sous des plafonds en briques rouges restaurées. Chaque chambre a une vue sur les jardins.\r\n\r\nPour votre plaisir, attendez-vous à ce qui suit en plus de tous les couloirs, foyers, chambres et suites dédiées :\r\n\r\nGrande cuisine avec vue sur les jardins,\r\nSalon avec cheminée,\r\nSalle à manger pouvant accueillir jusqu\'à 40 personnes,\r\nStudio de yoga avec tapis et traverses pour 10 praticiens,\r\nEspace dancefloor &amp;amp; bar avec réfrigérateur à vin,\r\nSauna finlandais,\r\nSalle de massage et salon,\r\nTour principale du château avec 4 mini salons et vue à 360 degrés depuis le salon supérieur.'),
(5, 'Villa luxueuse avec piscine', 'Biot', 06410, 7, 465, 873000, 'img/logements/logement_1655048862_1.jpg', 'img/logements/logement_1655048862_2.jpg', 'img/logements/logement_1655048862_3.jpg', 'vente', 'Un joyau balinais au cœur de la Provence : cette luxueuse villa moderne est au cœur du triangle d\'or de la Côte d\'Azur et offre une vue imprenable.\r\n\r\nConstruite sur 2 niveaux, la maison de 465 mètres carrés dispose de grandes fenêtres et de portes vitrées s\'ouvrant sur de vastes espaces de vie extérieurs sur les deux étages. Une terrasse en bois entoure la piscine à débordement chauffée et sa grande terrasse, tandis qu\'une pergola projette une ombre fraîche sur des chaises longues et une table à manger décontractée où vous pourrez vous asseoir et vous détendre sur le lit banquette pour profiter de la villa.\r\n\r\nÀ l\'intérieur, une élégante cuisine gastronomique ouverte avec accès direct à la salle à manger extérieure et intérieure comprend un bar en onyx et sert un salon/salle à manger à aire ouverte s\'ouvrant sur la piscine. Elle permet un aménagement facile et chaleureux pour les couples et les familles. 3 chambres design modernes ont leurs propres salles de bains et une autre chambre peut être convertie en une 4ème chambre confortable. Les murs blancs lumineux font ressortir le style contemporain vibrant.\r\n\r\nCaractéristiques : climatisation, appareils électroménagers modernes, foyer, piscine chauffée à l\'oxygène, terrain de pétanque, parking couvert pour plusieurs voitures.\r\n\r\nLa mer Méditerranée est à seulement 15 minutes et l\'aéroport à 25 minutes. Plusieurs commerces sont à proximité.\r\nVilla parfaite pour les familles, les couples et la retraite de yoga, elle a été conçue pour offrir une expérience de luxe ultime.\r\n\r\nLe jardin est conçu avec un hamac relaxant, un espace pour le yoga et la méditation ainsi qu\'un court de pétanque français typique !'),
(6, 'Tiny-house nature tout confort', 'Bages', 11100, 3, 35, 1720, 'img/logements/logement_1655049950_1.jpg', 'img/logements/logement_1655049950_2.jpg', 'img/logements/logement_1655049950_3.jpg', 'location', 'Voici notre cabane insolite de 35m², 100% artisanal et éco-conçu avec des matières nobles et locales. Il est situé au milieu d\'une zone boisée, au calme en connexion avec la nature. Relié aux réseaux d\'eau et d\'électricité vous pourrez profiter d\'une salle de bain privée et d\'une cuisine équipée. Sur la terrasse tout en bois vous pourrez cuisiner à la plancha et faire la sieste dans un filet suspendu en toute tranquillité ! Vous serez séduit par la déco et la zen-attitude qui y règne !'),
(7, 'Appartement en résidence fermée', 'Vincennes', 94300, 4, 98, 475000, 'img/logements/logement_1655052703_1.jpg', 'img/logements/logement_1655052703_2.jpg', NULL, 'vente', 'Dans une petite copropriété fermée et sécurisée à proximité immédiate de la gare et des commerces, ce bel appartement F4 situé au 2ème étage de 98m² saura séduire par son charme.\r\n\r\nIl dispose d\'un double séjour très lumineux exposé plein sud, ouvert sur un grand balcon avec une vue sur la forêt et sans aucun vis-à-vis, de 3 chambres avec grand placard intégré, d\'une salle d\'eau avec une douche à l\'italienne refaite à neuf, d\'une cuisine spacieuse aménagée et indépendante et d\'un espace bureau.\r\n\r\nUne cave de 20 m² et un double box au parking sous-sol complètent ce bien.\r\nA noter une possibilité de convenir en 4 chambres.\r\nDe belle présentation, ce bien atypique séduira dès sa 1ère visite.'),
(8, 'Loft rénové en bord de mer', 'Deauville', 14800, 5, 103, 2140, 'img/logements/logement_1655054791_1.jpg', 'img/logements/logement_1655054791_2.jpg', 'img/logements/logement_1655054791_3.jpg', 'location', 'A la recherche de grands espaces, ce loft est idéal pour vous ! Ce sublime loft de 103m², exposé sud-ouest, possède 4 chambres et a été entièrement rénové avec goût et des matériaux de qualité, où tout a été pensé avec minutie.\r\n\r\nVous aurez le choix, soit de parcourir les marches du très large escalier menant à l\'entrée de ce loft, soit de prendre l\'ascenseur privé menant directement dans la pièce à vivre d\'une hauteur sous plafond impressionnante.\r\n\r\nUne partie cuisine ouverte et délimitée par un bar, lui aussi atypique et construit sur mesure, composé d\'électroménager professionnel, dont une machine à glaçons. \r\n\r\nUn escalier en bois, toujours fait sur mesure, mène à la mezzanine pouvant servir de bureau, salon de lecture et/ou chambre d\'appoint.\r\nUne porte en bois sculpté donne accès au couloir dessert la première chambre équipée d\'une salle d\'eau/wc, puis au bout du couloir, une suite parentale, sa salle de bain/wc et son dressing.\r\n\r\nGrand balcon de 28 m², qui fait la longueur du loft, avec vue sur un petit parc au calme.\r\nChauffage par une climatisation réversible et/ou radiateurs électriques + cheminée au gaz de ville.\r\nAspiration centralisée.\r\nL\'entrée de la propriété est sécurisée par un portail électrique avec interphone et le bord de mer est à seulement 10 minutes à pied.'),
(9, 'Cabane perchée dans les arbres', 'La Houssière', 88430, 2, 32, 1980, 'img/logements/logement_1655056194_1.jpg', 'img/logements/logement_1655056194_2.jpg', 'img/logements/logement_1655056194_3.jpg', 'location', 'Située au cœur des Vosges, cette cabane perchée dans le sommet d\'un chêne rouvre est situé au cœur d\'un parc naturel et peut accueillir 4 à 6 personnes tout au long de l\'année.\r\n\r\nL\'accès se fait par un escalier autour de l\'arbre. La surface de la cabane fait 32,5 mètres carrés. Le salon dispose d\'un canapé-lit, d\'une cheminée électrique et d\'une télévision à écran plat uniquement pour connecter à une ordinateur. Elle est équipée d\'un coin repas afin que vous puissiez profiter de cette belle ambiance le temps d’un week-end en amoureux ou d’un séjour. La cuisine dispose d\'une cuisinière à induction, cafetière, micro-ondes et d\'un réfrigérateur avec partie congélateur.\r\n\r\nUne salle de bain avec cabine de douche, lavabo et un WC séparé. Sa généreuse mezzanine, accueillant un lit 140. Une connexion wifi est mise à votre disposition.\r\n\r\nLa terrasse de 40 m² surplombe un bel étang à la perspective apaisante, le tout sous la frondaison rafraîchissante du Chêne Rouvre, avec toutefois une petite extension qui ravira les amoureux du soleil. Il y a une piscine qui peut être utilisée si les propriétaires sont présents. Vous disposerez d\'un grand jardin clôturé et d\'un parking privé.\r\n\r\nLocation au mois ou à la nuit.'),
(10, 'Incroyable demeure dans une ferme', 'Cantegrouille', 40660, 3, 58, 680, 'img/logements/logement_1655395305_1.jpg', NULL, NULL, 'location', 'Ancienne ferme des Landes, entourée de pins et au milieu de la verdure, elle est située à environ 35 minutes des plus belles plages de la région et à proximité de nombreux endroits riches en histoire et culture. Le domaine dispose d\'une piscine commune avec un grand jardin fleuri entouré de beaux oliviers. A l\'extérieur la terrasse avec table privée, chaises et parasol.\r\n\r\nLa maison dispose de 2 chambres, cuisine équipée avec salle à manger, 1 salle de bain avec douche.\r\n\r\nPratique, à environ 5 minutes à pied de la ferme, se trouve un joli lac privé où il est possible de pratiquer la pêche ou simplement de se détendre en pleine nature.'),
(11, 'Villa d\'exception en bord de lac', 'Devesset', 07320, 9, 253, 1234500, 'img/logements/logement_1655395484_1.jpg', 'img/logements/logement_1655395484_2.jpg', 'img/logements/logement_1655395484_3.jpg', 'vente', 'Située en Ardèche, cette villa se trouve au bord du joli lac de la commune et dispose de 9 pièces dont 7 chambres. L\'endroit est idéal pour les amateurs de sport en plein air (natation, hiking, tennis, cyclisme, wakedoarding, etc) et offre des vues spectaculaires sur la montagne ardéchoise et le lac.\r\n\r\nLa maison de 250 m² a été construite par une famille d\'architecte dans les années 1930 et conserve encore beaucoup de son charme d\'antan avec également son parc de 1 hectare. Le centre-ville est à seulement 2 minutes.\r\n\r\nIdéale pour plusieurs familles, elle est dotée de deux terrasses extérieures pouvant bien sûr accueillir salon de jardin, plancha ou encore barbecue.'),
(12, 'Péniche atypique contemporaine', 'Bord\'eau', 33000, 2, 41, 590, 'img/logements/logement_1655397700_1.jpg', 'img/logements/logement_1655397700_2.jpg', NULL, 'location', 'Expérience unique et insolite à bord d\'une belle péniche aménagée à la structure contemporaine.\r\n\r\nEntre boiseries et modernité, vous séjournerez dans l\'ancien logement des mariniers, fonctionnel, chaleureux et original.\r\nCe petit studio flottant design, sur deux niveaux, avec tout le confort et au calme, dispose d\'un accès indépendant, d\'une chambre avec douche et des toilettes. Il est idéal pour un couple ou des parents avec 1 ou 2 enfants car elle offre un lit de 140 cm et un lit de 120 cm de large.\r\n\r\nUne terrasse privée, sur le pont arrière du bateau, et en face de la péniche sur le quai, restaurants, cafés, boulangeries et alimentation. Centre ville à 5 minutes.\r\n\r\nIntimité et dépaysement sont garantis !');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
