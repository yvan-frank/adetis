import { createRoot } from 'react-dom/client';

/**
 * Registre des îles disponibles : nom (attribut data-island) -> import
 * paresseux du composant. Ajouter une entrée ici pour chaque nouvelle île.
 */
const registry = {
    Hello: () => import('../islands/Hello'),
};

/**
 * Cherche tous les [data-island] du DOM et monte le composant React
 * correspondant, en lui passant les data-* comme props.
 */
export async function mountIslands() {
    const nodes = document.querySelectorAll('[data-island]');

    for (const node of nodes) {
        const name = node.dataset.island;
        const loader = registry[name];

        if (!loader) {
            console.warn(`[islands] aucune île enregistrée pour "${name}"`);
            continue;
        }

        const { default: Island } = await loader();
        const props = { ...node.dataset };

        createRoot(node).render(<Island {...props} />);
    }
}
