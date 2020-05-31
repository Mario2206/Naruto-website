<table>
        <thead>
            <tr>
                <?php 
                    foreach($keys as $k) :
                ?>

                    <th><?=$k ?></th>

                <?php
                    endforeach;  
                ?>

            </tr>
        </thead>
        <tbody>

            <?php
                foreach($data as $item):
            ?>

            <tr>

                <?php foreach($item as $entry) :  ?>

                <td><?=$entry; ?></td>

                <?php endforeach; ?>

            </tr>

            <?php
                endforeach;
            ?>

        </tbody>
    </table>