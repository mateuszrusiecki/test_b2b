<?php echo $this->Metronic->portlet('Lista ankiet'); ?>
<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                    #
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-user"></i> Klient
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-suitcase"></i> Projekt
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-comments"></i> Komentarz
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-star"></i> Ocena
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-cog"></i> Opcje
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($polls)) : ?>
                <?php foreach ($polls as $poll) : ?>
                    <?php
                    $rate = 0;
                    $comment = null;
                    foreach ($poll['PollQuestion'] as $question) {
                        if ($question['question'] === 'Komentarz') {
                            $comment = $question['PollAnswer']['answer'];
                        }
                        elseif ($question['question'] === 'Ogólna ocena projektu') {
                            $rate = intval($question['PollAnswer']['answer']);
                        }
                    }
                    ?>
                    <tr>
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            <?php echo $poll['Poll']['id']; ?>
                        </td>
                        <td><?php echo $poll['ClientProject']['Client']['name']; ?></td>
                        <td><?php echo $poll['ClientProject']['name']; ?></td>
                        <td><?php echo $comment; ?></td>
                        <td>
                            <div class="starOpinion">
                                <?php
                                $i = 1;
                                while ($i <= 5) : ?>
                                    <i class="fa fa-star font-large <?php echo ($i <= $rate ? 'font-yellow' : ''); ?>"></i>
                                    <?php
                                    $i++;
                                endwhile;
                                ?>
                            </div>
                        </td>
                        <td>
                            <a class="" href="<?php echo $this->Html->url(array(
                                'plugin' => 'poll',
                                'controller' => 'polls',
                                'action' => 'fill',
                                $poll['Poll']['hash'],
                            )); ?>">
                                <i tooltip="Podgląd" class="fa fa-link large-icon pull-right"></i> 
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        Brak danych
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPage" items-per-page="10" total-items="profiles | candidates:search_user_id | filter:search | length" boundary-links="true"></pagination>

<?php echo $this->Metronic->portletEnd(); ?>
