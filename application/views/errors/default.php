<?php
/**
 * Default error display page.
 * See "error views" documentation for available tags
 */
/** @var $e \flyingpiranhas\common\exceptions\FpException */
?>

<h1>An error has occurred.</h1>
<pre style="width=100%; overflow: auto">Code <?php echo $e->getCode().': '.$e->getMessage(); ?></pre>
<pre style="width=100%; overflow: auto"><?php echo $e->getFile().'('.$e->getLine().')'; ?></pre>
<pre style="width=100%; overflow: auto"><?php echo $e->getTraceAsString(); ?></pre>
<!--<h3>Todo: tags, parsing, templating language? We'll see</h3>-->
