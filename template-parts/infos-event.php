<?php 
  $taxonomies    = get_query_var('taxonomies');
  $dateObject    = get_query_var('dateObject');
  /**
   * Format d'affichage de la date
   * @link http://php.net/manual/fr/function.date.php
   * La fonction strtotime() essaye de lire une date au format anglais fournie par le paramètre time, et de la transformer en timestamp Unix
   * @link http://php.net/manual/fr/function.strtotime.php
   * date_i18n() renvoie la date au format local, ici, en français
   * @link https://codex.wordpress.org/Function_Reference/date_i18n
   */
  $dateformat    = 'l j F Y \à G\hi';
  $unixtimestamp = strtotime( $dateObject['value'] );
  $date          = date_i18n( $dateformat, $unixtimestamp );
?>

<ul class="infos">
  <li class="infos__row">
    <span class="infos__label"><?php echo $dateObject['label'] ?></span>
    <span class="infos__value"><?php echo $date; ?></span>
  </li>
  <?php foreach ( $taxonomies as $taxonomy ) :
        /**
         * On retourne un objet de chaque taxonomie pour pouvoir récupérer leur nom.
         * @link https://developer.wordpress.org/reference/functions/get_taxonomy/
         */
        $taxonomyName = get_taxonomy( $taxonomy );
        /**
         * Renvoie la liste des termes d'une taxonomie
         * @link https://developer.wordpress.org/reference/functions/get_terms/
         */
        $terms = get_terms( $taxonomy ); ?>
    <li class="infos__row">
      <span class="infos__label"><?php echo $taxonomyName->label; ?></span>
      <span class="infos__value"> 
        <?php foreach ( $terms as $term ) :
          /**
           * On récupère le lien du terme 
           * @link https://developer.wordpress.org/reference/functions/get_term_link/
           */ 
          $term_link = get_term_link( $term ); ?>
          <a class="infos__link" href="<?php echo $term_link; ?>"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
      </span>
    </li>
  <?php endforeach; ?>
</ul>