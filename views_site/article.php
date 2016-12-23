<a href="#" id="toTop">&#11575</a>

<section id="article">
    <div id="block">

        <?php if (isset($this->model->imgLink['first'])) { ?>
            <img src="<?php echo $this->model->imgLink['first'] ?>">
        <?php } ?>

        <h2><?php echo $this->model->title ?></h2>
        <p><?php echo $this->model->description ?></p>
        <div id="content"><?php echo $this->model->content ?></div>

        <?php if (isset($this->model->imgLink['second'])) { ?>
            <img src="<?php echo $this->model->imgLink['second'] ?>">
        <?php } ?>

    </div>
</section>