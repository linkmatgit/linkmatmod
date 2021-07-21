import React from 'react'

export const Field = React.forwardRef(({help, name, children, error, onChange, required, minLength}, ref) => {
    if(error) {
        help = error
    }
    return <div className="comment__textarea__content">
        <label htmlFor={name} className="control-label">{children}</label>
                <textarea ref={ref}
                          id={name}
                          className="form-control"
                          onChange={onChange}
                          required={required}
                          minLength={minLength}/>
            </div>
    {help && <div className="error__text">{help}</div>}
})