<?php $this->layout('base', ['title' => 'User Profile']) ?>

<?php $this->start('page') ?>
    <table>
    <?php for ($i=0; $i < 10; $i++): ?>
        <tr>

        <?php for ($j=0; $j < 10; $j++): ?>
            <td>
                <?php echo $i * $j; ?>
            </td>
        <?php endfor;?>
        </tr>
    <?php endfor; ?>
    </table>
<?php $this->stop() ?>

<?php $this->start('sidebar') ?>
    <?php echo $this->fetch('partials/default-sidebar')?>
<?php $this->stop() ?>


