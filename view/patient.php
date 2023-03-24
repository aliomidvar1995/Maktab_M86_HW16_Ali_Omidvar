<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
    </head>
    <body>
        <?php
        if($params['user']->rule === 'patient') {
        ?>
        <form class="mt-2" dir="rtl" action="/patient/search" method="post">
            <input type="text" name="text">
            <select name="search" id="">
                <option value="name">نام</option>
                <option value="expertise">تخصص</option>
            </select>
            <input type="submit" value="search">
        </form>
        <?php foreach ($params['patientIndex'] as $key => $value) {
            ?>
                <p class="bg bg-dark text-white w-50">
                    <?= $value['name'].' '.$value['expertise'].' '.$value['visit'] ?>
                </p>
            <?php
        }
        ?>
        <?php
        foreach($params['doctors'] as $doctor){
            ?>
        <img src="<?php echo '/images/'.$doctor['image'] ?>" alt="" style="width:100px;height:100px">
        <h2 dir="rtl"><?= $doctor['name']?></h2>
        <h5 dir="rtl"><?= $doctor['expertise'] ?></h5>
        <ul dir="rtl">
            <?php
            if(!empty($doctor['saturday'])) {
                ?>
            <li><?= ' شنبه : ' .  $doctor['saturday'] ?></li>
            <?php
            }
            ?>
            <?php
            if(!empty($doctor['sunday'])) {
                ?>
            <li><?=' یکشنبه : ' . $doctor['sunday'] ?></li>
                <?php
            }
                ?>
            <?php
            if(!empty($doctor['monday'])) {
                ?>
            <li><?=' دوشنبه : ' . $doctor['monday'] ?></li>
            <?php
            }
            ?>
            <?php
            if(!empty($doctor['tuesday'])) {
                ?>
            <li><?=' سه شنبه : ' . $doctor['tuesday'] ?></li>
            <?php
            }
            ?>
            <?php
            if(!empty($doctor['wednesday'])) {
                ?>
            <li><?=' چهارشنبه : ' . $doctor['wednesday'] ?></li>
            <?php
            }
            ?>
            <?php
            if(!empty($doctor['thursday'])) {
                ?>
            <li><?=' پنج شنبه : ' . $doctor['thursday'] ?></li>
            <?php
            }
            ?>
            <?php
            if(!empty($doctor['friday'])) {
                ?>
            <li><?=' جمعه : ' . $doctor['friday'] ?></li>
            <?php
            }
            ?>
        </ul>
        <form action="/patient" method="post">
            <input type="hidden" name="name" value="<?= $doctor['name'] ?? null ?>">
            <input type="hidden" name="expertise" value="<?= $doctor['expertise'] ?? null ?>">
            <input type="hidden" name="doctor_id" value="<?= $doctor['id'] ?? null ?>">
            <input type="hidden" name="user_id" value="<?= $params['user']->id ?>">
            <select name="visit">
                <?php if(!empty($doctor['saturday'])){ ?>
                <option value="<?= ' شنبه : ' .  $doctor['saturday'] ?>"><?= ' شنبه : ' .  $doctor['saturday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['sunday'])){ ?>
                    <option value="<?= ' یکشنبه : ' .  $doctor['sunday'] ?>"><?= ' یکشنبه : ' .  $doctor['sunday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['monday'])){ ?>
                    <option value="<?= ' دوشنبه : ' .  $doctor['monday'] ?>"><?= ' دوشنبه : ' .  $doctor['monday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['tuesday'])){ ?>
                    <option value="<?= ' سه شنبه : ' .  $doctor['tuesday'] ?>"><?= ' سه شنبه : ' .  $doctor['tuesday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['wednesday'])){ ?>
                    <option value="<?= ' چهارشنبه : ' .  $doctor['wednesday'] ?>"><?= ' چهارشنبه : ' .  $doctor['wednesday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['thursday'])){ ?>
                    <option value="<?= ' پنج شنبه : ' .  $doctor['thursday'] ?>"><?= ' پنج شنبه : ' .  $doctor['thursday'] ?></option>
                <?php } ?>
                <?php if(!empty($doctor['friday'])){ ?>
                    <option value="<?= ' جمعه : ' .  $doctor['friday'] ?>"><?= ' جمعه : ' .  $doctor['friday'] ?></option>
                <?php } ?>
                <input type="submit" value="ویزیت">
            </select>
        </form>
        <?php
        }
        }
        ?>
    </body>
</html>