from flask import flash
import pygal
from pygal import HorizontalStackedBar

def graph_horizontal_dynamic(dataset):
    graphs = []
    try:
        while len(dataset) > 0:
            for data in dataset:
                bar_chart = pygal.HorizontalStackedBar(width=data["width"], height=data["height"], \
                    spacing=data["spacing"], margin=data["margin"])
                bar_chart.title = data["title"]
                bar_chart.x_labels = data["labels"]
                bar_chart.add(data["info"], data["record"])
                graphs.append(bar_chart.render(is_unicode=True))
                dataset.remove(data)
        return graphs
    except Exception as e:
        return flash(str(e), "warning")


def get_cases(c_amount):
    cases = []
    i = 1
    while i <= c_amount:
        cases.append(i)
        i += 1
    return cases