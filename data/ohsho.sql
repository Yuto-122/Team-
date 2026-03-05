-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2026-03-05 08:34:48
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `ohsho`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kana` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `receive_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `contact`
--

INSERT INTO `contact` (`id`, `name`, `kana`, `email`, `message`, `receive_date`, `update_date`, `status`) VALUES
(1, '加藤朝雄', 'かとう あさお', 'katooooooooooooooooooooooooo@gmail.com', '餃子の王将はなぜ出店してないのですか？', '2026-02-26 11:46:12', '2026-02-26 11:46:12', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `type` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `type`, `create_date`) VALUES
(1, '入場料はかかりますか？', '入場は無料です。どなたでもご自由にお楽しみいただけます。飲食の購入は各店舗でお支払いください。', 1, '2026-02-26 11:03:19'),
(2, '開催時間を教えてください。', '平日は16:00 ~ 22:00、土日祝は11:00 ~ 22:00です。各日最終入場受付は21:00、ラストオーダーは21:15です。', 1, '2026-02-26 11:03:19'),
(3, '雨天の場合も開催されますか？', '雨天決行ですが、荒天の場合は安全を考慮し中止となる場合があります。最新情報はSNSでお知らせします。', 1, '2026-02-26 11:03:19'),
(4, '支払い方法を教えてください。', '現金のほか、主要な電子マネー・QRコード決済がご利用いただけます。', 1, '2026-02-26 11:03:19'),
(5, '喫煙所はありますか？', '会場内は全面禁煙ですが、敷地外に指定の喫煙エリアを設けています。スタッフの案内に従ってご利用ください。', 2, '2026-02-26 11:03:19'),
(6, '授乳室やおむつ替えスペースはありますか？', 'はい、メインゲート付近に授乳室とおむつ替え台を設置しています。小さなお子様連れでも安心してご利用いただけます。', 2, '2026-02-26 11:03:19'),
(7, '駐車場はありますか？', '専用駐車場はございません。公共交通機関のご利用をおすすめします。', 2, '2026-02-26 11:03:19'),
(8, 'ペットを連れて入場できますか？', '混雑が予想されるため、ペットの同伴はご遠慮ください。ただし補助犬は入場可能です。', 2, '2026-02-26 11:03:19'),
(9, 'ゴミはどうすればよいですか？', '会場内に分別ゴミ箱を設置しています。リサイクルにご協力をお願いします。', 2, '2026-02-26 11:03:19'),
(10, '忘れ物をした場合はどうすればよいですか？', '会場本部でお預かりしています。イベント終了後は実行委員会までお問い合わせください。', 3, '2026-02-26 11:03:19'),
(11, 'トイレはどこにありますか？', '会場内に複数の仮設トイレを設置しています。マップの「トイレ」アイコンをご確認ください。', 3, '2026-02-26 11:03:19'),
(12, 'SNSで写真を投稿しても良いですか？', 'はい、大歓迎です！公式ハッシュタグ「#ふくおか餃子FES」をつけて投稿してください。', 3, '2026-02-26 11:03:19'),
(13, '開催中止の場合はどうなりますか？', '安全を最優先に判断し、中止の場合は公式サイトとSNSでお知らせします。', 3, '2026-02-26 11:03:19'),
(14, '問い合わせ先を教えてください。', '「お問い合わせ」ページのフォームまたは事務局メール宛にご連絡ください。', 3, '2026-02-26 11:03:19');

-- --------------------------------------------------------

--
-- テーブルの構造 `faq_category`
--

CREATE TABLE `faq_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `link_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `faq_category`
--

INSERT INTO `faq_category` (`id`, `category`, `create_date`, `link_id`) VALUES
(1, 'イベントについて', '2026-02-26 10:45:36', 'event'),
(2, '会場について', '2026-02-26 10:45:36', 'venue'),
(3, 'その他', '2026-02-26 10:45:36', 'others');

-- --------------------------------------------------------

--
-- テーブルの構造 `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `info_img` varchar(255) DEFAULT NULL,
  `public_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `info`
--

INSERT INTO `info` (`id`, `title`, `body`, `info_img`, `public_date`, `update_date`, `created_date`) VALUES
(1, 'ふくおか餃子FES開催決定！', 'テキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキスト', 'news-sample-image-l.png', '2026-02-16 12:00:00', '2026-02-26 11:24:00', '2026-02-26 11:24:00'),
(2, '出店企業様募集中！', 'テキストテキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキストテキストテキスト<br>テキストテキストテキストテキストテキスト', 'news-sample-image-s.png', '2026-02-23 12:00:00', '2026-02-26 11:24:00', '2026-02-26 11:24:00'),
(3, '出店者インタビュー 博多区で人気の「博多ぎょうざ堂」', 'テキストテキストテキストテキスト', NULL, '2026-02-25 12:00:00', '2026-02-26 11:24:00', '2026-02-26 11:24:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `amount` int(3) NOT NULL,
  `price` int(11) NOT NULL,
  `menu_img` varchar(255) NOT NULL,
  `menu_b_pc_img` varchar(255) NOT NULL,
  `menu_b_sp_img` varchar(255) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `menus`
--

INSERT INTO `menus` (`id`, `name`, `body`, `amount`, `price`, `menu_img`, `menu_b_pc_img`, `menu_b_sp_img`, `shop_id`, `update_date`, `created_date`) VALUES
(1, '肉汁あふれる焼き餃子', '香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。', 6, 580, 'menu-01.png', 'menu-b-01.png', 'menu-b-01-sp.png', 1, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(2, 'ふっくら蒸しあげ餃子', 'もちもちの皮で包んだ餃子を、丁寧に蒸し上げた優しい味わいの一皿。蒸気でふっくら仕上げた皮はとろけるようにやわらかく、野菜と肉の旨味がじんわり広がります。特製のポン酢だれをつけて、さっぱりとお召し上がりください。', 8, 520, 'menu-02.png', 'menu-b-02.png', 'menu-b-02-sp.png', 2, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(3, '中華風スープ餃子', '香ばしく焼き上げた皮の中には、あふれんばかりの肉汁がぎっしり。厳選された国産豚とキャベツの旨味が広がる、満足感たっぷりの一品です。一口噛めば、ジュワッとした肉汁が口いっぱいに広がります。', 5, 680, 'menu-03.png', 'menu-b-03.png', 'menu-b-03-sp.png', 3, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(4, 'カリもち！揚げ餃子', '外はカリッ、中はもちっと食感が楽しい、人気の揚げ餃子。特製スパイスを混ぜ込んだ肉餡は、香ばしい皮と相性抜群。 おつまみとしても、おやつ感覚でも楽しめるクセになる味です。 熱々のうちに、レモンを絞ってどうぞ！', 5, 600, 'menu-04.png', 'menu-b-04.png', 'menu-b-04-sp.png', 4, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(5, 'お口に広がる地中海の風', 'オリーブオイルとハーブで仕上げた、地中海スタイルの創作餃子。しっとりとした皮に包まれた具材は、チーズ・オリーブ・トマトの香りが絶妙なバランス。芳醇なオイルソースとハーブの香りが口いっぱいに広がります。 ワインにもぴったりな、上品な一皿。', 5, 720, 'menu-05.png', 'menu-b-05.png', 'menu-b-05-sp.png', 5, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(6, '素材の旨味ひきたつ水餃子', '国産野菜と豚肉の旨味をぎゅっと閉じ込めた、つるんと食感の水餃子。素材本来の味を生かすため、化学調味料を使わず丁寧に手包み。あっさりとした特製だれで、いくつでも食べられる軽やかな味わいです。 熱々のままでも、冷やしてもおいしい万能餃子。', 8, 550, 'menu-06.png', 'menu-b-06.png', 'menu-b-06-sp.png', 6, '2026-02-26 10:46:40', '2026-02-26 10:46:40'),
(7, 'しびうまラー油餃子', '自家製の花椒ラー油をたっぷり絡めた、刺激的な一皿。ひと口食べれば、山椒のしびれと唐辛子の辛味がじわっと広がり、ジューシーな肉餡の旨味が後を引きます。 辛党必食！ 病みつきになる辛さでリピーター続出。', 6, 620, 'menu-07.png', 'menu-b-07.png', 'menu-b-07-sp.png', 7, '2026-02-26 10:46:40', '2026-02-26 10:46:40');

-- --------------------------------------------------------

--
-- テーブルの構造 `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kana` varchar(255) DEFAULT NULL,
  `booth` varchar(6) NOT NULL,
  `description` text NOT NULL,
  `update_date` datetime NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `shops`
--

INSERT INTO `shops` (`id`, `name`, `kana`, `booth`, `description`, `update_date`, `created_date`) VALUES
(1, '博多ぎょうざ堂', '', 'B-01', '福岡を代表する老舗餃子専門店。国産豚とキャベツを使用し、ひとつひとつ手包みで仕上げています。外はカリッと、中は肉汁たっぷりの博多スタイルが人気。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(2, '中華食堂 蒸々屋', 'むしむしや', 'B-02', '優しい味わいの蒸し料理を得意とする中華食堂。ふっくら蒸し上げた餃子や点心が好評で、家族連れにも人気。手作りの皮が自慢です。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(3, '餃子茶寮 彩香', 'さいか', 'B-03', '和のテイストを取り入れた創作中華が魅力の茶寮。旨味たっぷりのスープ餃子をはじめ、彩り豊かなメニューを提供しています。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(4, '餃子バル 風雷坊', 'ふうらいぼう', 'B-04', 'スタイリッシュな餃子バルとして若者に人気。ビールやワインとの相性を考えたスパイシーな揚げ餃子が名物。夜の一杯にぴったり。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(5, 'Mediterraneo Gyoza', 'メディテラネオ ギョウザ', 'B-05', '地中海の食文化を融合した創作餃子専門店。オリーブやハーブを使った新感覚の餃子で女性客に人気。見た目も華やか。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(6, '餃子処 湯心', 'ゆごころ', 'B-06', '素材の味を大切にした、体にやさしい餃子を提供。化学調味料不使用の水餃子が看板商品。シンプルながら深い味わいです。', '2026-02-26 10:45:36', '2026-02-26 10:45:36'),
(7, '辛味房 赤龍', 'しんみぼう せきりゅう', 'B-07', '本格四川の技を受け継ぐ辛味料理専門店。花椒を効かせた「しびうまラー油餃子」が人気で、辛党ファンが多数来店。', '2026-02-26 10:45:36', '2026-02-26 10:45:36');

-- --------------------------------------------------------

--
-- テーブルの構造 `support_status`
--

CREATE TABLE `support_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `support_status`
--

INSERT INTO `support_status` (`id`, `status`, `create_date`) VALUES
(1, '未対応', '2026-02-26 11:10:22'),
(2, '対応中', '2026-02-26 11:10:22'),
(3, '対応済', '2026-02-26 11:10:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `create_date`) VALUES
(1, 'admin', '$2y$10$AF76yhWsxa8XFBVaFu3Z1OO/SeD/eayCs6m/V/9BFFb5zvl6fKqxK', '2026-02-26 11:53:35'),
(2, 'yamada', '$2y$10$LhaTNtmNqX4VyD5WvLnXROoPskT0ftGtjULhJ8wkf.nDmOzKxXJXu', '2026-03-02 12:08:04');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- テーブルのインデックス `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- テーブルのインデックス `faq_category`
--
ALTER TABLE `faq_category`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- テーブルのインデックス `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booth` (`booth`);

--
-- テーブルのインデックス `support_status`
--
ALTER TABLE `support_status`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `faq_category`
--
ALTER TABLE `faq_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `support_status`
--
ALTER TABLE `support_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`status`) REFERENCES `support_status` (`id`);

--
-- テーブルの制約 `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_ibfk_1` FOREIGN KEY (`type`) REFERENCES `faq_category` (`id`);

--
-- テーブルの制約 `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
