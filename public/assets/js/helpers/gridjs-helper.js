/**
 * GridHelper - Classe para facilitar a criação de grids com Grid.js
 */
class GridHelper {
  constructor(options = {}) {
    this.container = options.container;
    this.apiUrl = options.apiUrl;
    this.columns = options.columns || [];
    this.pageSize = options.pageSize || 12;
    this.searchInput = options.searchInput;
    this.language = options.language || this.getDefaultLanguage();
    this.className = options.className || this.getDefaultClassName();
    this.debounceDelay = options.debounceDelay || 350;
    
    this.grid = null;
    this.currentSearch = '';
    
    this.init();
  }

  getDefaultLanguage() {
    return {
      pagination: {
        previous: 'Anterior',
        next: 'Próximo',
        showing: 'Mostrando',
        of: 'de',
        to: 'até',
        results: 'resultados'
      }
    };
  }

  getDefaultClassName() {
    return {
      tr: 'linha-clicavel',
      table: 'table table-centered table-nowrap mb-0',
      thead: 'table-light',
    };
  }

  debounce(fn, delay) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => fn(...args), delay);
    };
  }

  buildUrl(page, limit) {
    const laravelPage = page + 1; // Grid.js usa 0-based, Laravel usa 1-based
    const actualLimit = limit || this.pageSize;
    
    const params = new URLSearchParams();
    params.set('page', laravelPage);
    params.set('limit', actualLimit);
    
    if (this.currentSearch) {
      params.set('search', this.currentSearch);
    }
    
    return `${this.apiUrl}?${params.toString()}`;
  }

  init() {
    if (!this.container || !this.apiUrl) {
      console.error('GridHelper: container e apiUrl são obrigatórios');
      return;
    }

    this.setupGrid();
    this.setupEvents();
  }

  setupGrid() {
    this.grid = new gridjs.Grid({
      columns: this.columns,
      className: this.className,
      search: { enabled: false }, // Sempre desabilitado
      sort: true,
      server: {
        url: (prev, page, limit) => this.buildUrl(page, limit),
        method: 'GET',
        then: (data) => {
          if (!data.data || !Array.isArray(data.data)) {
            console.error('GridHelper: Resposta da API inválida', data);
            return [];
          }
          return data.data;
        },
        total: (data) => data.total || 0
      },
      pagination: {
        enabled: true,
        limit: this.pageSize,
        summary: true,
        server: {
          url: (prev, page, limit) => this.buildUrl(page, limit)
        }
      },
      language: this.language
    }).render(this.container);

    // Remove a busca padrão do Grid.js após renderizar
    this.removeDefaultSearch();
  }

  removeDefaultSearch() {
    // Aguarda um pouco para garantir que o Grid.js terminou de renderizar
    setTimeout(() => {
      const searchBox = this.container.querySelector('.gridjs-search');
      if (searchBox) {
        searchBox.remove();
      }
    }, 100);

    // Observer para remover se aparecer novamente
    const observer = new MutationObserver(() => {
      const searchBox = this.container.querySelector('.gridjs-search');
      if (searchBox) {
        searchBox.remove();
      }
    });

    observer.observe(this.container, {
      childList: true,
      subtree: true
    });
  }

  setupEvents() {
    // Busca personalizada
    if (this.searchInput) {
      this.searchInput.addEventListener('input', this.debounce((e) => {
        this.currentSearch = e.target.value || '';
        this.refresh();
      }, this.debounceDelay));
    }
  }

  refresh() {
    this.grid.updateConfig({
      server: {
        url: (prev, page, limit) => this.buildUrl(page, limit),
        then: (data) => {
          if (!data.data || !Array.isArray(data.data)) {
            console.error('GridHelper: Resposta da API inválida', data);
            return [];
          }
          return data.data;
        },
        total: (data) => data.total || 0
      }
    }).forceRender();
  }

  // Métodos públicos para controle externo
  search(term) {
    this.currentSearch = term;
    if (this.searchInput) {
      this.searchInput.value = term;
    }
    this.refresh();
  }

  destroy() {
    if (this.grid) {
      this.grid.destroy();
    }
  }
}

// Exporta para uso global
window.GridHelper = GridHelper;