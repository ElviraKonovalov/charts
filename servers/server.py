from flask import Flask, render_template
import plotly.graph_objects as go
import chart_studio
import chart_studio.plotly as py
import chart_studio.tools as tls
import pandas as pd
import json
import plotly

'''
Web Visualization with Plotly and Flask:
https://towardsdatascience.com/web-visualization-with-plotly-and-flask-3660abf9c946
'''
app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/activity_recap')
def activity_recap():
    # Load data
  df = pd.read_csv("data.csv")

  # Create figure
  fig = go.Figure()

  y_miles = df.Distance
  y_km = df.Distance * 1.60934

  fig.add_trace(
      go.Bar(x=df.Date, y=y_miles, marker_color='indianred'))

  # Set title
  fig.update_layout(
      title_text="Activity Recap",
      title_x=0.5
  )

  # Add range slider
  fig.update_layout(
      yaxis=dict(
          title='Distance',
          titlefont_size=16,
          tickfont_size=14,
      ),
      xaxis=dict(
          rangeselector=dict(
              buttons=list([
                  dict(count=7,
                       label="WEEK",
                       step="day",
                       stepmode="backward"),
                  dict(count=1,
                       label="MONTH",
                       step="month",
                       stepmode="backward"),

                  dict(count=1,
                       label="YEAR",
                       step="year",
                       stepmode="backward"),
                  dict(label="ALL",
                       step="all")
              ])
          ),
          rangeslider=dict(
              visible=False
          ),
          type="date"
      )
  )

  # https://stackoverflow.com/a/68899741
  updatemenus = [{
                  'buttons': [{'method': 'update',
                               'label': 'Km/Miles',
                               'args': [
                                        # 1. updates to the traces
                                        {'y': [y_km],
                                         'visible': True},
                                         # 2. updates to the layout
                                        {'yaxis_title_text':'Distance (km)'},
                                        # 3. which traces are affected 
                                        [0, 1],
                                        
                                        ],
                               'args2': [
                                         # 1. updates to the traces  
                                         {'y': [y_miles],
                                         'visible':True},
                                         # 2. updates to the layout
                                        {'yaxis_title_text':'Distance (miles)'},
                                         # 3. which traces are affected
                                         [0, 1]
                                        ]
                                },
                              ],
                  'type':'buttons',
                  'direction': 'down',
                  'showactive': True,}]
  fig.update_layout(updatemenus=updatemenus)

  graphJSON = json.dumps(fig, cls=plotly.utils.PlotlyJSONEncoder)
  return render_template('activity_recap.html', graphJSON=graphJSON)


@app.route('/moving_avg')
def moving_avg():
  df=pd.read_csv("biking.csv")
  df["moveAvg"] = df["km/hr"].rolling(5).mean()

  fig = go.Figure([go.Scatter(x=df["date"], y=df["moveAvg"])])

  fig.update_layout(
    title_text="Moving Average",
    title_x=0.5,
    yaxis=dict(
    title='km/hr',
    titlefont_size=16,
    tickfont_size=14))

  graphJSON = json.dumps(fig, cls=plotly.utils.PlotlyJSONEncoder)
  return render_template('moving_avg.html', graphJSON=graphJSON)


if __name__ == '__main__':
  app.run(debug=True)