<a href="#" id="toTop">&#11575</a>

<div id="article">
    <div id="block">

        <?php if (isset($this->model->imgLink['first'])){?>
            <img src="<?php echo $this->model->imgLink['first']?>">
        <?php } ?>

        <?php if (isset($this->model->imgLink['second'])){?>
            <img src="<?php echo $this->model->imgLink['second']?>">
        <?php } ?>

        <h2><?php echo $this->model->title?></h2>
        <cite><?php echo $this->model->description?></cite>
        <div id="content"><?php echo $this->model->content?></div>

    </div>
</div>