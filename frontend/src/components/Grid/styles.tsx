import styled from 'styled-components';

export const Container = styled.div`
  background-color: white;
  width: fit-content;
  margin-left: auto;
  margin-right: auto;
  height: fit-content;
  border-radius: 20px;
  overflow: hidden;
  padding: 40px;

  button {
    background-color: #722ae6;
    outline: 0;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
    margin-top: 20px;
    color: white;

    &:hover {
      background-color: #e4b5cb;
      cursor: pointer;
    }
  }
`;

export const Cell = styled.div`
  background-color: #b3cdd1;
  border: 1px solid black;
  display: grid;
  place-items: center;
  color: white;
  font-weight: bold;
  font-size: 16px;
`;
