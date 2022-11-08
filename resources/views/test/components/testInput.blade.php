<tr>
    <td colspan="4">
        {{ $test->analysis->name }} 
    </td>
    <td colspan="13" align="right">
        @include('components.buttonDelete', [
            'urlDestroy' => route('api.test.destroy', $test),
            'urlRedirect' => route('test.edit', $sample->id)
        ])
    </td>
</tr>
