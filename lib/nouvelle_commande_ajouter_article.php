<?php

require_once '../lib/Commande.php';
require_once '../lib/ArticleCommande.php';
require_once '../lib/connexion.php';

session_start();

if(!isset($_SESSION["commande"])) {
    header('Location: nouvelle_commande.php');
    exit();
}

$commande = $_SESSION["commande"];

// Récupération des informations de l'article
$db = creerConnexion();
$req = "SELECT intitule, prix_unitaire FROM article WHERE id_article = " . $_GET["id_article"];
$result = $db->query($req);
$article_data = $result->fetch_assoc();

// Ajout de l'article à la commande
$article = new ArticleCommande($_GET["id_article"], $article_data["intitule"], $_GET["quantite"], $article_data["prix_unitaire"], false);
$commande->ajouterArticle($article);

$_SESSION["commande"] = $commande;

header("Location: ../pages/nouvelle_commande_articles.php");