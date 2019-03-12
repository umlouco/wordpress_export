<?php if (!empty($posts)): ?>
    <table class="table dataTables">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>guid</th>
                <?php for ($i = 0; $i < $colums; $i++): ?>
                    <th></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $p): ?>
                <tr>
                    <td><?php echo $p->ID; ?></td>
                    <td><?php echo $p->post_title; ?></td>
                    <td><?php echo $p->guid; ?></td>
                    <?php for ($i = 0; $i < $colums; $i++): ?>
                        <td><?php if (!empty($p->terms[$i])) echo $p->terms[$i]; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<script>
    jQuery(document).ready(function ($) {
        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                    }
                }
            ]

        });

    });

</script>