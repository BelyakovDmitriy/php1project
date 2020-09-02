function add_basket(elem)
{
    let data = new FormData();
    data.set('id_good', elem.getAttribute('data-good_id'));
    data.set('quantity', elem.previousElementSibling.value);

    let promise = fetch('', {
        method: 'POST',
        body: data
    });
/*
    promise.then(function(response)
        {
            return response.text();
        }
    ).then(function(text)
        {
            console.log(elem.getAttribute('data-good_id'), '/', elem.previousElementSibling.value);
        }
    );*/
}