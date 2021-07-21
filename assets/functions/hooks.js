import { flash } from '/Elements/Alert.js'
import {ApiError, jsonFetch} from "/functions/JsonFetch";
import {useCallback, useEffect, useState} from "react";

export function useToggle (initialValue = null) {
    const [value, setValue] = useState(initialValue)
    return [value, useCallback(() => setValue(v => !v), [])]
}
export function usePrepend (initialValue = []) {
    const [value, setValue] = useState(initialValue)
    return [
        value,
        useCallback(item => {
            setValue(v => [item, ...v])
        }, [])
    ]
}

export function useJsonFetchOrFlash (url, params = {}) {
    const [state, setState] = useState({
        loading: false,
        data: null,
        done: false
    })
    const fetch = useCallback(
        async (localUrl, localParams) => {
            setState(s => ({ ...s, loading: true }))
            try {
                const response = await jsonFetch(localUrl || url, localParams || params)
                setState(s => ({ ...s, loading: false, data: response, done: true }))
                return response
            } catch (e) {
                if (e instanceof ApiError) {
                    flash(e.name, 'danger', 4)
                } else {
                    flash(e, 'danger', 4)
                }
            }
            setState(s => ({ ...s, loading: false }))
        },
        [url, params]
    )
    return { ...state, fetch }
}

export function useAsyncEffect (fn, deps = []) {
    /* eslint-disable */
    useEffect(() => {
        fn()
    }, deps)
    /* eslint-enable */
}

export const PROMISE_PENDING = 0
export const PROMISE_DONE = 1
export const PROMISE_ERROR = -1

/**
 * Décore une promesse et renvoie son état
 */
export function usePromiseFn (fn) {
    const [state, setState] = useState(null)
    const resetState = useCallback(() => {
        setState(null)
    }, [])

    const wrappedFn = useCallback(
        async (...args) => {
            setState(PROMISE_PENDING)
            try {
                await fn(...args)
                setState(PROMISE_DONE)
            } catch (e) {
                setState(PROMISE_ERROR)
                throw e
            }
        },
        [fn]
    )

    return [state, wrappedFn, resetState]
}