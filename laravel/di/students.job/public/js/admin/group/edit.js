// слушатель события загрузки страницы
window.addEventListener('load', load);


function load() {
    // записываем в переменную данные, пришедшие из PHP
    const data = JSON.parse(document.querySelector('#data').value);

    const place = document.querySelector('#place');
    const faculty = document.querySelector('#faculty_id');

    const place_changed = (e) => {
        const place_id = parseInt(e.target.options[e.target.selectedIndex].value);
        const get_faculties = (place_id) => {
            return data
                .filter(f => f.education_place_id === place_id)
                .map((f) => { return { id: f.id, title: f.title } });

        }
        const update_faculties = (faculties) => {
            while (faculty.hasChildNodes()) { faculty.removeChild(faculty.lastChild) }

            for (let i = 0; i < faculties.length; i++) {
                // createDocElement({ type: 'img', class: 'sj-photo', attributes: { src: '/photos/' + data[i].photo } })
                const option = document.createElement("option");
                option.value = faculties[i].id;
                option.innerHTML = faculties[i].title;
                faculty.appendChild(option);
            }
            faculty.value = null;
        }
        update_faculties(get_faculties(place_id));
    };
    place.onchange = place_changed;

    place.dispatchEvent(new Event("change"));

    const selected_faculty_id = JSON.parse(document.querySelector('#selected_faculty_id').value);
    faculty.value = selected_faculty_id;
}