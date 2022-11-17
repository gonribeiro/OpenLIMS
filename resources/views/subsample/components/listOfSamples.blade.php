<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Internal ID</th>
            <th>Customer</th>
            <th>Actual Storage Location At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($samples->reverse() as $sample)
            <tr>
                <td>{{ $sample->id }}</td>
                <td>{{ $sample->internalId ?? '-' }}</td>
                <td>{{ $sample->customer->name }}</td>
                <td>{{ $sample->lastCustody?->storage->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>