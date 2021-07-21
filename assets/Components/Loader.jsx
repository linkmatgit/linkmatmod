/**
 * Loader animé
 */
import React from 'react';
export function Loader ({ className = 'icon', ...props }) {
    return <spinning-dots className={className} {...props} />
}