<?php

require_once 'Utils.php';

class ArticleCommande
{

    public $intitule = "";
    public $id;
    public $quantite;
    public $prix_unite;

    public function __construct($id, $intitule, $quantite, $prix_unite)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->quantite = $quantite;
        $this->prix_unite = $prix_unite;
    }

    public function afficherLigneCommande($i) {
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $this->intitule; ?></td>
            <td><?php echo $this->quantite; ?></td>
            <td><?php echo formaterPrix($this->prix_unite); ?></td>
            <td><?php echo formaterPrix($this->recupererTotal()); ?></td>
        </tr>
        <?php
    }

    public function afficherLigneEditerCommande($id_commande, $i) {
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <?php $this->afficherInfos(); ?>
            <td>
                <a class="link-danger"
                   href="../lib/enlever_article.php?id_commande=<?php echo $id_commande; ?>&id_article=<?php echo $this->id?>">
                    Retirer l'article
                </a>
            </td>
        </tr>
        <?php
    }

    public function recupererTotal() {
        return $this->prix_unite * $this->quantite;
    }

}