
const fetchMiscellaneous = (data, userRole) => {

const xhr = new EasyHttp();

        let html = '';

        const token = data._token;

        xhr.post('/miscellaneous/fetch', data)
            .then(datas => {
 
            	let i = 1;
        
                datas.forEach((data) => {
                
                html+= `<tr> 
                    <td> ${i++} </td>
                    <td> ${data.name}  </td>
                    <td> ${data.make} </td>
                    <td> ${data.description} </td>
                    <td> ${data.quantity} </td>
                    <td> &#8358; ${ new Intl.NumberFormat().format(data.price)  } </td>
                    <td>
                       
                	${ userRole == "employee" ? '' : `<a href="/miscellaneous/${data.id}/edit" class="btn btn-small btn-info">
                        <i class="btn-icon-only icon-edit"></i> </a> `
                    }
                    ${ userRole == "admin" ?
                        `<form method="POST"  style="display:inline;" action="/miscellaneous/${data.id}/destroy">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="${token}" >
                        <button type="submit" onclick=" return confirm('this Action cannot be undone Are you Sure you want to delete this product')"  class="btn btn-small btn-danger">
                        <i class="btn-icon-only icon-remove"></i></button>
                        </Form>` : '' 
                    } 

                        <a href="/miscellaneous/${data.id}/edit_stock" class="btn btn-small btn-light">
                        <i class="btn-icon-only icon-plus"></i> Update Stock ! </a>

                    </td>
                </tr> `;
                })
            

                document.getElementById('miscTable').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('miscTable').innerHTML = 
                `<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> No Product Found !! </strong>
                </div>`;
            });


        }