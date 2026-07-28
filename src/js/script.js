const form = document.getElementById('formWhisky');
    const listaWhiskys = document.getElementById('listaWhiskys');
    const listaFavoritos = document.getElementById('listaFavoritos');

    // Carregar favoritos do localStorage
    let favoritos = JSON.parse(localStorage.getItem('favoritos')) || [];

    function renderFavoritos() {
      listaFavoritos.innerHTML = '';
      favoritos.forEach(fav => {
        const div = document.createElement('div');
        div.className = 'favorito-item';
        div.textContent = fav;
        listaFavoritos.appendChild(div);
      });
    }

    function addToFavorites(whisky) {
      if (!favoritos.includes(whisky)) {
        favoritos.push(whisky);
        localStorage.setItem('favoritos', JSON.stringify(favoritos));
        renderFavoritos();
        alert(whisky + " foi adicionado aos seus favoritos!");
      } else {
        alert(whisky + " já está nos favoritos!");
      }
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const nome = document.getElementById('nome').value;
      const descricao = document.getElementById('descricao').value;
      const promo = document.getElementById('promo').value;

      const card = document.createElement('div');
      card.className = 'whisky-card';
      card.innerHTML = `
        <h2>${nome}</h2>
        <p>${descricao}</p>
        ${promo ? `<div class="promo">Promoção: ${promo}</div>` : ''}
        <button onclick="addToFavorites('${nome}')">Adicionar aos Favoritos</button>
      `;
      listaWhiskys.appendChild(card);

      form.reset();
    });

    // Renderizar favoritos ao carregar
    renderFavoritos();