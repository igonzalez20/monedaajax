(function () {

/* variables 'globales' de la función                                     */

    let lastPage = '';
    let pageNumber = 1;
    let route = '';
    let rows = 3;
    let token = '';

/* listener CRUD*/
    let addMonedaModal = document.getElementById('AddMoneda');
    if(addMonedaModal) {
        addMonedaModal.addEventListener('click', function (event) {
            addMoneda();
        });    
    }

    let editMonedaModal = document.getElementById('EditMoneda');
    if(editMonedaModal) {
        editMonedaModal.addEventListener('click', function (event) {            
            editMoneda();
        });    
    }

    let DeleteMonedaModal = document.getElementById('DeleteMoneda');
    if(DeleteMonedaModal) {
        DeleteMonedaModal.addEventListener('click', function (event) {
            deleteMoneda();
        });    
    }
    

 
/* END listener CRUD*/

/* listener MODAL CRUD*/
    let tbody = document.getElementById('tbody');
    if(tbody) {
        tbody.addEventListener('click', function (event) {
            if(event.target.classList.contains('editModal')) {
                document.body.classList.add('body');
                
                getMoneda(event.target.dataset.id);                
            }
            if(event.target.classList.contains('deleteModal')) {
                console.log("delete");
                document.getElementById('nameBorrar').innerHTML = event.target.dataset.name;
                route = 'ajaxmoneda/' + event.target.dataset.id;
                $('#DeleteModal').modal('show');
            }
        });    
    }
/* END listener MODAL CRUD*/

/*METODOS CRUD*/

    /*Delete*/
    function deleteMoneda() {
        let url = route;
        document.body.classList.add('body');
        fetch(url, {
            body: getFormdata() + "&lastPage=" + encodeURIComponent(lastPage),
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            method: 'delete',
        })
        .then(function(response) {
            document.body.classList.remove('body');
            return response.json();
        })
        .then(function (data) {
                route = 'ajaxmoneda/';
                $('#DeleteModal').modal('hide');
                createTableDom(data);
                createLinkDom(data);
            console.log('Request succeeded with JSON response', data);
        })
        .catch(function (error) {
            console.log('Request failed', error);
        });
    }

    /*EDIT*/
    function editMoneda() {
        let data = getFormdata('editMonedaForm');
        let url = route;
        document.body.classList.add('body');
        fetch(url, {
            body: data,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            method: 'put',
        })
        .then(function(response) {
            document.body.classList.remove('body');
            return response.json();
        })
        .then(function (data) {
            actualizarMoneda(data);
            $('#EditModal').modal('hide');
            console.log('Request succeeded with JSON response', data);
        })
        .catch(function (error) {
            console.log('Request failed', error);
        });
    }

    function actualizarMoneda(data) {
        let id = data.moneda.id;        
        document.getElementById('td' + id + "_0").textContent = data.moneda.name;
        document.getElementById('td' + id + "_1").firstChild.nodeValue = data.moneda.symbol;
        document.getElementById('td' + id + "_2").textContent = data.moneda.country;
        document.getElementById('td' + id + "_3").textContent = data.moneda.value;
        document.getElementById('td' + id + "_4").textContent = data.moneda.date;
    }

    /*ADD*/
    function addMoneda() {
        let data = getFormdata('addMonedaForm');
        let url = 'ajaxmoneda';
        document.body.classList.add('body');        
        fetch(url, {
            body: data,
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            method: 'post',
        })
        .then(function(response) {
            document.body.classList.remove('body');            
            return response.json();
        })
        .then(function (data) {
            mostrarMoneda(data);
            $('#AddModal').modal('hide');
            let form = document.getElementById('addMonedaForm');
            form.reset();
            console.log('Request succeeded with JSON response', data);
        })
        .catch(function (error) {
            console.log('Request failed', error);
        });
    }

    function getFormdata(idForm = '') {
        let data = '';
        if(idForm != '') {
            let form = document.getElementById(idForm);
            if(form) {
                let formData = new FormData(form); //multipart/form-data
                for(var entry of formData.entries()) {
                    data += encodeURIComponent(entry[0]) + '=' + encodeURIComponent(entry[1]) + '&';
                }    
            }
        }
        data += '_page=' + pageNumber + '&';
        data += '_token=' + token;
        return data;
    }

    function mostrarMoneda(data) {
        let tr = createTr(data.moneda);
        let tbody = document.getElementById('tbody');
        tbody.appendChild(tr);
    }



/*REGOGER DATOS Y MOSTRAR */

    function getMoneda(id) {
        fetch('ajaxmoneda/' + id)
        .then(function(response) {
            return response.json();
        })
        .then(function(json) {
            document.body.classList.remove('body');
            if(json.moneda.id) {
                document.getElementById('nameEdit').value = json.moneda.name;
                document.getElementById('symbolEdit').value = json.moneda.symbol;
                document.getElementById('countryEdit').value = json.moneda.country;
                document.getElementById('valueEdit').value = json.moneda.value;
                document.getElementById('dateEdit').value = json.moneda.date;
                route = 'ajaxmoneda/' + json.moneda.id;
                $('#EditModal').modal('show');
            } else {
                alert('Error, la empresa ya no existe.');
            }
        })
        .catch(function(error) {
            document.body.classList.remove('body');
            alert('error');
            console.log('Request failed', error)
        });
    }
    function getPage(page) {
        lastPage = page;
        console.log("url mala   "+page);
        fetch(page)
        .then(function(response) {
            return response.json();
        })
        .then(function(json) {
            
            console.log(json);
            createTableDom(json);
            createLinkDom(json);

            token = json.token;            
            pageNumber = json.monedas.current_page;
            console.log("token: "+token);
            console.log("page: "+pageNumber);
        })
        .catch(function(error) {
            alert('error');
            console.log('Request failed', error)
        });
    }
    getPage('ajaxmoneda');

    function deleteChildNodes(id) {
        let element = document.getElementById(id);        
        if(element) {
            while(element.firstChild){
                element.removeChild(element.firstChild);
            }    
        }
    }
    /* CREATE TABLA Y DATOS*/
    function createTableDom(jsonComplete) {
        deleteChildNodes('tbody');
        let tbody = document.getElementById('tbody');
        let json = jsonComplete.monedas;
        for(let i = 0; i < json.data.length; i++) {            
            tbody.appendChild(createTr(json.data[i]));
        }
    }

    function createTr(json) {
        let tr = document.createElement('tr');
        let id = json.id;
        tr.appendChild(createTd(id));
        tr.appendChild(createTd(json.name, [], [{name: 'name', value: id + '_' + 0}], id + '_' + 0));
        tr.appendChild(createTd(json.symbol, [], [{name: 'name', value: id + '_' + 1}], id + '_' + 1));
        tr.appendChild(createTd(json.country, [], [{name: 'name', value: id + '_' + 2}], id + '_' + 2));
        tr.appendChild(createTd(json.value, [], [{name: 'name', value: id + '_' + 3}], id + '_' + 3));
        tr.appendChild(createTd(json.date, [], [{name: 'name', value: id + '_' + 4}], id + '_' + 4));        
        tr.appendChild(createTd('add', [],));        
        tr.appendChild(createTd('edit', ['pointer', 'azul', 'editModal'], [{name: 'id', value: id},
                                                                              {name: 'symbol', value: json.symbol},
                                                                              {name: 'country', value: json.country},
                                                                              {name: 'value', value: json.value},
                                                                              {name: 'date', value: json.date},
                                                                            ]));
        tr.appendChild(createTd('delete', ['pointer', 'azul', 'deleteModal'], [{name: 'id', value: id}, {name: 'name', value: json.name}]));
        return tr;
    }

    function createTd(text, classNames = [], data = [], id = '') {
        let td = document.createElement('td');
        let node = document.createTextNode(text);
        td.appendChild(node);
        if(id != '') {
            td.id = 'td' + id;
        }
        //https://stackoverflow.com/questions/3010840/loop-through-an-array-in-javascript
        for (const className of classNames) {
            td.classList.add(className);
        }
        for (const dataAttribute of data) {
            td.dataset[dataAttribute.name] = dataAttribute.value;
        }
        return td;
    }

    /* CREATE DATOS PAGINACION*/
    function createLinkDom(jsonComplete) {
        deleteChildNodes('enlacesPaginacion');
        let enlaces = document.getElementById('enlacesPaginacion');
        let json = jsonComplete.monedas;
        for(let i = 0; i < json.links.length; i++) {
            let enlace = createLink(json.links[i]);
            enlaces.appendChild(enlace);
        }
    }

    function createLink(json) {
        let li;
        if(json.active) {            
            li = createLinkActual(json);
        } else {
            if(json.url) {                
                li = createLinkPage(json);
            } else {                
                li = createLinkDisabled(json);
            }
        }
        return li;
    }

    //enlace de paginación a la página actual
    function createLinkActual(json) {
        let li = document.createElement('li');
        li.classList.add('page-item');
        li.classList.add('active');
        li.setAttribute('aria-current', 'page');
        let span = document.createElement('span');
        span.classList.add('page-link');
        let node = document.createTextNode(decodeLabel(json.label));
        span.appendChild(node);
        li.appendChild(span);
        return li;
    }

    //enlace de paginación deshabilitado
    function createLinkDisabled(json) {
        let li = document.createElement('li');
        li.classList.add('page-item');
        li.classList.add('disabled');
        li.setAttribute('aria-disables', 'true');
        li.setAttribute('aria-label', json.label);
        let span = document.createElement('span');
        span.classList.add('page-link');
        span.setAttribute('aria-hidden', 'true');
        let node = document.createTextNode(decodeLabel(json.label));
        span.appendChild(node);
        li.appendChild(span);
        return li;
    }

    //enlace de paginación a una página que existe
    function createLinkPage(json) {
        let li = document.createElement('li');
        li.classList.add('page-item');
        li.classList.add('pointer');
        let a = document.createElement('a');
        li.classList.add('page-link');
        a.dataset.url = json.url;
        a.dataset.page = json.label;
        a.addEventListener('click', function(event) {
            event.preventDefault();
            getPage(event.target.dataset.url);
        });
        let node = document.createTextNode(decodeLabel(json.label));
        a.appendChild(node);
        li.appendChild(a);
        return li;
    }

    //crea la lista de enlaces de paginación
    function createLinkDom(jsonComplete) {
        deleteChildNodes('enlacesPaginacion');
        let enlaces = document.getElementById('enlacesPaginacion');
        let json = jsonComplete.monedas;
        for(let i = 0; i < json.links.length; i++) {
            let enlace = createLink(json.links[i]);
            enlaces.appendChild(enlace);
        }
    }

    //para decodificar los enlaces de página anterior y siguiente de forma correcta
    //son estos dos símbolos que daban problemas: « y »
    function decodeLabel(jsonLabel) {
        var textarea = document.createElement('textarea');
        textarea.innerHTML = jsonLabel;
        return textarea.value;
    }
})();