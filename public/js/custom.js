var result;
function getData(url, parent, selected = null) {
    $.ajax({
        url: url,
        type: "GET",
        success: function(res) {
            result = res;
            $.each(res, function(index, data) {
                if (selected && selected == data.id) {
                    var option =
                        `<option value=` +
                        data.id +
                        ` selected="selected" >` +
                        data.name +
                        `</option>`;
                } else {
                    var option =
                        `<option value=` +
                        data.id +
                        `>` +
                        data.name +
                        `</option>`;
                }
                console.log(option);
                $(parent).append(option);
            });
        }
    });
}

function getDataByName(url, parent) {
    $.ajax({
        url: url,
        type: "GET",
        success: function(res) {
            result = res;
            $.each(res, function(index, data) {
                var option =
                    `<option value=` +
                    data.name +
                    `>` +
                    data.name +
                    `</option>`;
                $(parent).append(option);
            });
        }
    });
}

function populateList(url, parent, modal) {
    $.ajax({
        url: url,
        type: "GET",
        success: function(res) {
            $.each(res, function(index, data) {
                var row =
                    `<tr class=` +
                    (index % 2 == 0 ? "odd pointer" : "even pointer") +
                    `>
                    <td style='cursor:pointer' id='data' data-toggle='modal' data-target=` +
                    modal +
                    ` data-info='` +
                    data.id +
                    `,` +
                    data.name +
                    `,` +
                    (data.atoll
                        ? data.atoll.id + `,` + data.atoll.name
                        : null) +
                    `,` +
                    (data.island
                        ? data.island.id + `,` + data.island.name
                        : null) +
                    `' class=" ">` +
                    data.name +
                    `&nbsp;&nbsp;<i class="fa fa-pencil"></i></td>` +
                    (data.atoll
                        ? `<td style='cursor:pointer'>` +
                          data.atoll.name +
                          `</td>`
                        : null) +
                    (data.island
                        ? `<td style='cursor:pointer'>` +
                          data.island.name +
                          `</td>`
                        : null) +
                    `
                        <td class="last" id='delete' data-toggle='modal' data-target='#deleteModal' data-info='` +
                    data.id +
                    `'><a href="#">Delete&nbsp;<i class="fa fa-trash"></i></a></td>
                    </tr>`;
                $(parent).append(row);
            });
        }
    });
}
