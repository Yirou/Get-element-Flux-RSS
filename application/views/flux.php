<!--
  Auteur Yirou
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <link media="screen" href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet"/>
    <head>
        <meta charset="utf-8">
        <title>
            
            <?php echo $title; ?></title>
    </head>
    <body>
        <hr>
        <div class="container" >
            <div  class="alert alert-info"><a href="<?php base_url() ?>"><i class="glyphicon glyphicon-home"></i>
            </a> <h3>Coucou :) Flux RSS Korben</h3></div>
            <hr>
            <div class="row">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date édition</th>
                            <th>Description</th>
                            <th>Nombre commentaire</th>
                            <th>Lire la suite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rss as $item):
                            $datetime = date_create($item->pubDate);
                            $date = date_format($datetime, 'd/m/Y, H\hi');
                            ?>
                            <tr>
                                <td><?php echo $item->title; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $item->description; ?></td>
                                <td><?php echo count($item->comments) ?></td>
                                <td><a href="<?php echo $item->link; ?>" target=_blank class="btn btn-info">Plus d'info</a></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <?php
                echo $this->pagination->create_links();
                ?> 
            </div>
        </div>
    </body>
</html>
