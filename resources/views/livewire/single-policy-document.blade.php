<div>
    @foreach ($documents as $doc)
    <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
        <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900"><a href="#">{{$doc->document_name}}</a></div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm text-gray-900"><a href="#">{{$topic->name}}</a></div>
        </td>
      </tr>
      @endforeach
</div>
