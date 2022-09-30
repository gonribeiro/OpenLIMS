<td colspan="4">
    {{ $test->analysis->name }} 
</td>
<td colspan="13">
    @include('components.buttonDelete', [
        'urlDestroy' => route('api.test.destroy', $test),
        'urlRedirect' => route('sample.edit', $samples->implode('id', ','))
    ])
</td>
