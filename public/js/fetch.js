

 
 const getProductMake = (xhr, elementId1, elementId2, callBack = 0)  => {

        const productId = document.getElementById(elementId1);

        productId.addEventListener('change', function(e){

        let html = '<option value=""> Select Make ... </option>';

        const productId = e.target.value;


        xhr.get(`/make/${productId}/fetch`, data)
            .then(datas => {

            datas.forEach((data) => {
                html += `
                <option value="${data.id}"> ${data.name} </option>
               `;
            })

            document.getElementById(elementId2).innerHTML = html;
              
            })

        data.product_id = productId; // get Product Name Id
        data.make = null;
        data.model = null;

        // fetch product with the product name only
        callBack(data, userRole);

        })

 };


  const getProductModel = (xhr, elementId1, elementId2, callBack = 0)  => {

        const makeId = document.getElementById(elementId1);

        makeId.addEventListener('change', function(e){

        let html = '<option value=""> Select Make ... </option>';

        const makeId = e.target.value;

        xhr.get(`/model/${makeId}/fetch`, data)
            .then(datas => {

            datas.forEach((data) => {
                html += `
                <option value="${data.id}"> ${data.name} </option>
               `;
            })

            document.getElementById(elementId2).innerHTML = html;
              
            })

        data.make = makeId;
        data.model = null;

        callBack(data, userRole);

        })

 };



        