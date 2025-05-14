-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/08/2024 às 21:23
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jose`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carrinhos`
--

CREATE TABLE `tb_carrinhos` (
  `id_carrinho` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_carrinhos`
--

INSERT INTO `tb_carrinhos` (`id_carrinho`, `id_cliente`) VALUES
(1, 10),
(2, 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nome`, `email`, `senha`, `endereco`, `ativo`, `tipo`) VALUES
(10, 'Gustavo', 'ga@gmail.com', 'gu', 'ceep', 1, 'cliente'),
(11, 'Gustavo', 'gu@gmail.com', 'gu', 'ceep', 1, 'admin'),
(12, 'admin', 'admin', 'admin', 'admin', 1, 'admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
  `id_item` int(11) NOT NULL,
  `id_carrinho` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_pedidos`
--

INSERT INTO `tb_pedidos` (`id_item`, `id_carrinho`, `id_produto`, `quantidade`) VALUES
(2, 1, 15, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id_produto` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id_produto`, `nome`, `descricao`, `preco`, `categoria`, `imagem`, `ativo`) VALUES
(15, 'Camiseta Stranger Happy Tree Friends (Laranja)', 'Camiseta Masculina Stranger, simplicidade, conforto e estilo, confeccionada em malha simples 100% algod?o. Estampa em silk, gola careca caimento normal.', 69.00, 'Camisetas', './Imagens/003_frente.jpg', 1),
(16, 'Camiseta Stranger Square Letters (Vinho)', 'Camiseta Masculina Stranger, simplicidade, conforto e estilo, confeccionada em malha simples 100% algod?o. Estampa em silk, gola careca caimento normal.', 69.00, 'Camisetas', './Imagens/001_frente.jpg', 1),
(17, 'Camiseta Stranger Garfield Stoned (Orquidea)', 'Camiseta Masculina Stranger, simplicidade, conforto e estilo, confeccionada em malha simples 100% algod?o. Estampa em silk, gola careca caimento normal.', 69.00, 'Camisetas', './Imagens/002_frente.jpg', 1),
(28, 'Calça Jeans Delave XXL', 'Calça Jeans DeLave XXL\r\n\r\nReviva o estilo icônico da década de 90 com a Calça Jeans DeLave XXL. Inspirada na clássica calça balão, esta peça combina o charme vintage com o conforto e a durabilidade modernos. Perfeita para quem busca uma peça versátil e estilosa para compor looks despojados e autênticos.', 189.00, 'Calças', './Imagens/xxl.png', 1),
(29, 'Calça Cargo Pixain Hip Hop Wear', 'Na cena desde 1983 a Pixain é hip hop desde o primeiro dia, pra você que curte um pano mais largo essa é a marca certa!\r\nTecido sarja 100% algodão, supreenda-se com a qualidade do material.', 189.00, 'Calças', './Imagens/pixain.png', 1),
(30, 'Calça Brothas And Cash Yin Yang', 'Medidas conforme tabela nas fotos. Consulte a disponibilidade de cores e tamanhos. Brothas and Cash Street Wear de verdade! pra você que curte um pano mais largo essa é a marca certa! Tecido jeans 100% algodão, supreenda-se com a qualidade do material. Não hesite em tirar dúvida antes da compra, estamos à disposição.', 250.00, 'Calças', './Imagens/yingyang.png', 1),
(31, 'Bermuda Jeans Masculina Adulto', 'Bermuda masculina confeccionada em jeans e elastano. Possui modelagem tradicional, apresenta lavagem estonada, conta com bolsos frontais e posteriores. Peça ideal para compor looks em dias mais quentes, combine com camiseta da coleção e sapatênis.\r\n\r\nEstilo: Casual\r\n\r\nModelagem: Tradicional\r\n\r\nCategoria: Bermudas', 114.00, 'Bermudas', './Imagens/jeans1.png', 1),
(32, 'Bermuda Jeans Pitt Basic Stretch Masculina Branco', ' Bermuda Jeans Pitt Basic Stretch Masculina, é uma escolha versátil e confortável para o guarda-roupa masculino. Confeccionada com tecido jeans de qualidade, esta bermuda oferece flexibilidade e um ajuste confortável.', 199.00, 'Bermudas', './Imagens/jeans2.png', 1),
(33, 'Bermuda Masculina Assedio Jeans Slim Preto', 'Nossa bermuda é uma peça ideal para o vestuário de todo homem. Versátil e icônica, confeccionada a partir de um tecido durável conhecido como denim, que é caracterizado por sua densidade e resistência. Nossas bermudas jeans são populares tanto por sua aparência casual quanto por sua capacidade de resistir ao desgaste do uso diário', 139.00, 'Bermudas', './Imagens/jeans3.png', 1),
(34, 'Moletom Stranger Stoned Bong (Preto)', 'Medidas da peça no tamanho:\r\n\r\nP- Largura 60cm , Altura 72 cm , Manga 67 cm\r\n\r\nM - Largura 62cm, Altura 73cm, Manga 68 cm\r\n\r\nG -Largura 64 cm, Altura 75cm, manga 69 cm\r\n\r\nGG- Largura 66cm, Altura 78cm, 70 cm Manga\r\n\r\nMoletom 50% Algodão / 50% Poliester', 134.00, 'Moletons', './Imagens/moleta1.png', 1),
(35, 'Moletom Stranger Support Your Block Homies (Preto)', 'Medidas da peça no tamanho:\r\n\r\nP- Largura 60cm , Altura 72 cm , Manga 67 cm\r\n\r\nM - Largura 62cm, Altura 73cm, Manga 68 cm\r\n\r\nG -Largura 64 cm, Altura 75cm, manga 69 cm\r\n\r\nGG- Largura 66cm, Altura 78cm, 70 cm Manga\r\n\r\nMoletom 50% Algodão / 50% Poliester', 197.00, 'Moletons', './Imagens/moleta2.png', 1),
(36, 'Moletom Stranger Alien Abduction (Lilas)', 'Medidas da peça no tamanho:\r\n\r\nP- Largura 60cm , Altura 72 cm , Manga 67 cm\r\n\r\nM - Largura 62cm, Altura 73cm, Manga 68 cm\r\n\r\nG -Largura 64 cm, Altura 75cm, manga 69 cm\r\n\r\nGG- Largura 66cm, Altura 78cm, 70 cm Manga\r\n\r\nMoletom 50% Algodão / 50% Polieste', 134.00, 'Moletons', './Imagens/moleta3.png', 1),
(39, 'SB Dunk Low StrangeLove', 'A StrangeLove Skateboards criou uma estética única, combinando criatividade caótica com os fundamentos do que torna o skate divertido. A peculiar marca da Califórnia agora se une à Nike SB para emprestar sua perspectiva incomum a um sneaker querido: o Dunk Low. Este drop vem com um design em veludo texturizado com sobreposições de camurça. StrangeLove literalmente deixa sua marca com ilustrações de caveira bordadas em cada lateral. Por outro lado, os estampas discretas de coração mostram amor, bem a tempo do Dia dos Namorados.', 899.00, 'Tênis', './Imagens/dunk.png', 1),
(44, 'Tênis Nike Dunk Low SB x Grateful Dead ', 'A Nike Skateboarding se uniu à lendária banda de rock psicodélico Grateful Dead para lançar o Nike SB Dunk Low Grateful Dead Bears Yellow, agora disponível no Droper.', 899.00, 'Tênis', './Imagens/dunk2.png', 1),
(45, 'Tênis Nike Air Max Plus “PSG”', 'Deixe sua atitude ter vantagem no Air Max Plus. Sua estrutura em forma de chama adiciona calor às ruas, enquanto a malha arejada mantém você fresco. E você tem uma experiência Nike Air ajustada que oferece estabilidade premium e amortecimento inacreditável.', 1350.00, 'Tênis', './Imagens/dunk3.png', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  ADD PRIMARY KEY (`id_carrinho`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_carrinho` (`id_carrinho`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  MODIFY `id_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  ADD CONSTRAINT `tb_carrinhos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`);

--
-- Restrições para tabelas `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD CONSTRAINT `tb_pedidos_ibfk_1` FOREIGN KEY (`id_carrinho`) REFERENCES `tb_carrinhos` (`id_carrinho`),
  ADD CONSTRAINT `tb_pedidos_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
