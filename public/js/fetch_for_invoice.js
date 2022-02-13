
const fetchProduct = (data, userRole) => {

const xhr = new EasyHttp();

        let html = '';
        const url = data.url;
        const token = data._token;

        xhr.post('/product/fetch', data)
            .then(datas => {
 
            	let i = 1;

                datas.forEach((data) => {
                
                html+= `
                <tr> 
                    <td> ${data.product_name.name}  </td>
                    <td> ${data.make.name} </td>
                    <td> ${data.model.name} </td>
                    <td> &#8358; ${ new Intl.NumberFormat().format(data.cost)  } </td>     
                    <td>
                    <form method="post" action="${url}"> 
                        <!-- Product Details -->
                        <input type="hidden" name="_token" value="${token}">
                        <input type="hidden" name="product_id" value="${data.id}" >
                        <input type="hidden" name="product_cost" value="${data.cost}" >
                        <input type="number" name="quantity" style="width:35px" min="1" max="${data.quantity}" value="1" required /> 
                        <input type="submit" class="btn btn-small btn-primary"
                        value="Add+" />
                    </form>
                    </td>
                </tr>` ;
                })
            

                document.getElementById('productTable').innerHTML = html;
            })
            .catch(err => {
                document.getElementById('productTable').innerHTML = 
                `<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong> No Product Found !! </strong>
                </div>`;
            });


        }