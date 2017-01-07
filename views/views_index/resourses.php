<section id="resourses">

    <div>

        <i>Сегодня <?php echo date("d.m.Y") ?></i>

        <h3>Курс валют по данным Центрального банка Российской Федерации на
                <?php echo $cbrSoap->lastDateCbr->format('d.m.Y') ?> </h3>

        <table>

            <tr>
                <th></th>
                <th>Код</th>
                <th>Наименование валюты</th>
                <th>Курс</th>
            </tr>

<?php $i = 1; foreach ($cursesArr as $item){ ?>
            <tr>

                <td><?php echo $i?></td>
                <td><?php echo $item['code']?></td>
                <td><?php echo $item['name']?></td>
                <td><?php echo $item['curs']?></td>

            </tr>
<?php $i++;} ?>

        </table>
    </div>

</section>

<div id="toadmin">
    <p>&copy;2016. All rights reserved.</p>
</div>