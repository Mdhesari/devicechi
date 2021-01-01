<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<div>
    <li class="list-group-item">

        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach (array_keys($data) as $label)
                    <th>@lang($label)</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($data as $value)
                    <td>@lang($value)</td>
                    @endforeach
                </tr>
            </tbody>
        </table>

    </li>
</div>