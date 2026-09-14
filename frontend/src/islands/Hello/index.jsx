import { useState } from 'react';

/**
 * Île d'exemple : montre le flux data-* -> props et un appel API basique.
 * À supprimer une fois la première vraie île ajoutée au registre.
 */
export default function Hello({ name = 'monde' }) {
    const [count, setCount] = useState(0);

    return (
        <div style={{ padding: 12, border: '1px solid #ddd', borderRadius: 4 }}>
            <p>Bonjour, {name} — île React montée depuis PHP.</p>
            <button type="button" onClick={() => setCount((c) => c + 1)}>
                Compteur : {count}
            </button>
        </div>
    );
}
