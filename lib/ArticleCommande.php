<?php

class ArticleCommande
{

    private $intitule = "";
    private $id;
    private $quantite;
    private $prix_unite;

    private $fmt;

    public function __construct($id, $intitule, $quantite, $prix_unite)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->quantite = $quantite;
        $this->prix_unite = $prix_unite;

        $this->fmt = new NumberFormatter("fr_FR", NumberFormatter::CURRENCY);
    }

    public function afficherLigneCommande($i) {
        ?>
        <tr>
            <th scope="row"><?php echo $i; ?></th>
            <td><?php echo $this->intitule; ?></td>
            <td><?php echo $this->quantite; ?></td>
            <td><?php echo $this->fmt->formatCurrency($this->prix_unite, "EUR"); ?></td>
            <td><?php echo $this->fmt->formatCurrency($this->recupererTotal(), "EUR"); ?></td>
        </tr>
        <?php
    }

    public function recupererTotal() {
        return $this->prix_unite * $this->quantite;
    }
}