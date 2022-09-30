<tr class="collapse" id="collapseTest{{ $i }}">
    <td colspan="3">
        {{ $test->analysis->name }}
    </td>
    <td colspan="11">
        @include('components.buttonDelete', [
            'urlDestroy' => route('api.test.destroy', $test),
            'urlRedirect' => route('sample.edit', $samples->implode('id', ','))
        ])
    </td>
</tr>