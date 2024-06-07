<tfoot class="ps-6">
    <tr>
      <td colspan="6">
        {!!  App\Helpers\Helper::get_pagination_summary($linkData)  !!}
      </td>
      <td colspan="5">{!! $linkData->links() !!} </td>
    </tr>
</tfoot>